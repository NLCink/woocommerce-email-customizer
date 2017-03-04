<?php
class CSVExport
{
    /**
    * Constructor
    */
    public function __construct()
    {
        if(isset($_GET['export']))
        {
        $csv = $this->generate_csv();
        $generatedDate = date('d-m-Y His'); 
        ob_clean();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"ready-forms-{$generatedDate}.csv\";" );
        header("Content-Transfer-Encoding: binary");
        echo $csv;        
        exit;
        }
    }

    /**
    * Converting data to CSV
    */
    public function generate_csv()
    {
        global $wpdb;
        $csv_output = '';
        $postId = $_GET['export'];
        $multiple = (isset($_GET['multiple']) ? $_GET['multiple'] : '');
        if(!empty($multiple)){
            $get_post_data = $wpdb->get_results("SELECT pm.post_id, pm.meta_key as title , pm.meta_value as value FROM gpm_postmeta as pm WHERE  pm.post_id IN ($postId) AND pm.meta_key LIKE '_comp_%' ORDER BY pm.meta_id ASC");
        } else {
            $get_post_data = $wpdb->get_results("SELECT pm.post_id, pm.meta_key as title , pm.meta_value as value FROM gpm_postmeta as pm WHERE pm.post_id=$postId AND pm.meta_key LIKE '_comp_%' ORDER BY pm.meta_id ASC");
        }
        
        $csv_output .= "Title,Values,";
        $csv_output .= "\n";

        foreach ($get_post_data as $key => $value) {
            $export_title = explode("_", $value->title);
            if(($export_title[2] != 'order' && $export_title[3] != 'type') && $export_title[2] != 'status'){
                
            if($export_title[2] == 'product' && $export_title[3] == 'id'){
                $csv_output .= "Product Name,";
                $order = wc_get_order( $value->post_id );
                $items = $order->get_items(); 

                foreach ( $items as $item ) {
                    $product_id = $item['product_id'];
                    if ( ! empty( $item['variation_id'] ) && 'product_variation' === get_post_type( $item['variation_id'] ) ) {
                        $productID = $item['variation_id'];
                      } elseif ( ! empty( $item['product_id']  ) ) {
                        $productID = $item['product_id'];
                      } else {
                        $productID = 0;
                      }
                      $get_product_id=explode('-', $value->value);
                    if($productID == $get_product_id[0]){
                        $product_name = $item['name'];
                        $formatted_meta = array();
                        $hideprefix = '_';
                        if ( ! empty( $item['item_meta_array'] ) ) {
                          foreach ( $item['item_meta_array'] as $meta_id => $meta ) {
                            if ( "" === $meta->value || is_serialized( $meta->value ) || ( ! empty( $hideprefix ) && substr( $meta->key, 0, 1 ) === $hideprefix ) ) {
                              continue;
                            }
                            $attribute_key = urldecode( str_replace( 'attribute_', '', $meta->key ) );
                            $meta_value    = $meta->value;

                            // If this is a term slug, get the term's nice name
                            if ( taxonomy_exists( $attribute_key ) ) {
                              $term = get_term_by( 'slug', $meta_value, $attribute_key );

                              if ( ! is_wp_error( $term ) && is_object( $term ) && $term->name ) {
                                $meta_value = $term->name;
                              }
                            }               

                            $formatted_meta[ $meta_id ] = array(
                              'value' => apply_filters( 'woocommerce_order_item_display_meta_value', $meta_value ),
                            );

                          }
                        }
                        $delimiter = ", \n";
                        if ( ! empty( $formatted_meta ) ) {
                          $meta_list = array();

                          foreach ( $formatted_meta as $meta ) {
                              $meta_list[] = wp_kses_post( $meta['value'] );
                          }

                          if ( ! empty( $meta_list ) ) {
                            $output_attribute = $meta_list[0];//implode( $delimiter, $meta_list );
                          }
                        } 
                        if($item['qty'] >1 ){
                            $item_qty = ' x 1';
                        } else {
                            $item_qty = ' x '.$item['qty'];
                        }
                        $csv_output .= $product_name.$item_qty.' - '.$output_attribute.",";
                    }
                }
            } else {
                $csv_output .= ucfirst($export_title[2])." ".ucfirst($export_title[3]).",";
                $csv_output .= $value->value.",";
            }
            $csv_output .= "\n";
        }
        }

        return $csv_output;
    }
}

// Instantiate a singleton of this plugin
$csvExport = new CSVExport();

?>