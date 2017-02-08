<?php
get_header();
$orderId=(!empty($_GET['order_id']) ? $_GET['order_id'] : 0);
$order = wc_get_order( $orderId );
if(empty($order))
die('Order is not valid, contact with IT help desk!');

$get_order_number = get_post_meta( $orderId, "_order_number", true );
?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>js/jquery.validate.js"></script>
<div id="main-content">

<div class="wraper clearfix">
      <div class="container">
        <section class="order-section area">
          <h4 class="order-no"><span>Order # <?php echo $get_order_number; ?></span> - <font class="allProductDes"></font></h4>
          <h2 class="progress-title">Your Progress <span class="progress-lenght">45%</span></h2>
          <div class="progress-container">
            <div class="progressbar" style="width:45%"></div>
          </div>
          <h3 class="order-form-titie">Please complete the forms(s) bellow to complete your order</h3>


            <?php
            $inc=1;
            $tot=0;
            $fill=0;
            foreach( $order->get_items() as $item_id => $item ) {            
              //echo $order->display_item_meta( $item );
            //echo $order->get_formatted_line_subtotal( $item );
            //print_r($item['item_meta_array']);
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

                if ( ! empty( $item['variation_id'] ) && 'product_variation' === get_post_type( $item['variation_id'] ) ) {
                $_product = wc_get_product( $item['variation_id'] );
                $productID = $item['variation_id'];
              } elseif ( ! empty( $item['product_id']  ) ) {
                $productID = $item['product_id'];
                $_product = wc_get_product( $item['product_id'] );
              } else {
                $productID = 0;
                $_product = false;
              }

                $formatted_meta[ $meta_id ] = array(
                  'key'   => $meta->key,
                  'label' => wc_attribute_label( $attribute_key, $_product ),
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

            $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
            if(!empty($get_order_id)){
              $get_company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}", true );
              $get_company_url = get_post_meta( $orderId, "_comp_company_url_{$productID}", true );
              $get_blog_topic = get_post_meta( $orderId, "_comp_blog_topic_{$productID}", true );
              $get_blog_url = get_post_meta( $orderId, "_comp_blog_url_{$productID}", true );
              $get_reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}", true );
              $get_keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}", true );
              $get_conneting_words = get_post_meta( $orderId, "_comp_conneting_words_{$productID}", true );
              $get_special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}", true );
              $get_order_type = get_post_meta( $orderId, "_comp_order_type_{$productID}", true );
              
            } else {
              $get_company_name = '';
              $get_company_url = '';
              $get_blog_topic = '';
              $get_blog_url = '';
              $get_reference_url = '';
              $get_keywords = '';
              $get_conneting_words = '';
              $get_special_instructions = '';
              $get_order_type = '';
            }
             $get_product_id = $item['product_id'];
             $post_product = get_post($get_product_id); 
             $slug_product = $post_product->post_name;
             $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );

             $allProductDes[] = $productName.' - '.$output_attribute;

            ?>

          <div class="divider"></div>

          <h3 class="form-name">Form <?php echo $inc; ?></h3>
          <div class="word-wrap">
            <h3 class="word-count">Product: <?php 
              echo $productName;
              echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );
              echo ' - ';
              echo $output_attribute; ?></h3>
            <a href="#" class="btn-order-clear">Demo</a>
          </div>
          <div class="form-wrap area">
            <div class="alert alert-success alert-success-<?php echo $productID; ?>" style="display: none;">
            <strong>Success!</strong> Indicates a successful or positive action.
          </div>
          <?php if(!empty($get_order_type) && $get_order_type == 'complete') { $fill++; ?>
          <div class="form-wrap area">
            <div class="alert alert-success alert-success-<?php echo $productID; ?>">
            <strong>Success!</strong> Complete this form.
          </div>
          <?php } else { ?>
            <form class="order-form area orderForm-<?php echo $productID; ?>" id="orderForm-<?php echo $productID; ?>" data-order-id="<?php echo $productID; ?>" action="#" method="post">
            <input type="hidden" name="product_id" value="<?php echo $productID; ?>">
              <?php 
              if($slug_product == 'branded-blog-posts'){
                include('branded-blog-posts.php'); 
              } else if($slug_product == 'meta-tag-descriptions'){
                include('meta-tag-descriptions.php'); 
              } else if($slug_product == 'web-page-rewrites'){
                include('web-page-rewrites.php');
              } else if($slug_product == 'premium-seo-articles'){
                include('premium-seo-articles.php');
              } else if($slug_product == 'press-releases'){
                include('press-releases.php');
              } else if($slug_product == 'product-descriptions'){
                include('product-descriptions.php');
              } else if($slug_product == 'social-media-posts'){
                include('social-media-posts.php');
              } else if($slug_product == 'specialty-blog-posts'){
                include('specialty-blog-posts.php');
              } else if($slug_product == 'specialty-web-pages'){
                include('specialty-web-pages.php');
              } else if($slug_product == 'web-pages'){
                include('web-pages.php');
              } else {
                echo 'This product is invalide for this order complition form! Please contact with it help desk.'
              }
              

              ?>
              <div class="word-wrap">            
                <button type="submit" onclick="" name="order_type" class="btn-order-fill" value="save">
                <i class="fa fa-refresh fa-spin" aria-hidden="true" style="display: none;"></i>
                Save
                </button> 
                <button type="submit" name="order_type" class="btn-order-clear btn-color-white" value="complete">
                 <i class="fa fa-refresh fa-spin" aria-hidden="true" style="display: none;"></i>
                Complete
                </button> 
              </div>
            </form>
            <?php } ?>
            <script type="text/javascript">
              $(document).ready(function(){
                $(".orderForm-<?php echo $productID; ?>").validate();
              });
            </script>

          </div>
        <?php
            $inc++;
            $tot++;
        }
        $filupInDiv = (100/$tot);
        $filupInPer = $filupInDiv*$fill;
        $allProductD = implode( ' & ', $allProductDes );
        ?>
        </section>



      </div>
    </div>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>main.css" />
</div> <!-- #main-content -->
<script type="text/javascript">
$(document).ready(function(){
  $('.progress-lenght').html('<?php echo round($filupInPer,2); ?>%');
  $('.progressbar').css('width','<?php echo round($filupInPer,2); ?>%');
  $('.allProductDes').html('<?php echo $allProductD; ?>');
});
$(document).on("click", ":submit", function(e){
      var order_type = $(this);
      var orderId = order_type.closest("form").attr('data-order-id');
      var formId = order_type.closest("form").attr('id');
      order_type.find(".fa-refresh").css("display", "inline-block");
      var company_name = $('#'+formId).find("input[name=company_name]");
      var company_url = $('#'+formId).find("input[name=company_url]");
      var blog_topic = $('#'+formId).find("input[name=blog_topic]");
      var blog_url = $('#'+formId).find("input[name=blog_url]");
      var reference_url = $('#'+formId).find("input[name=reference_url]");
      var keywords = $('#'+formId).find("input[name=keywords]");
      var conneting_words = $('#'+formId).find("input[name=conneting_words]");
      var product_id = $('#'+formId).find("input[name=product_id]");
      var special_instructions = $('#'+formId).find("textarea[name=special_instructions]");
      if (company_name.val()==""|| company_url.val()=="" || blog_topic.val()=="" 
        || blog_url.val()=="" || reference_url.val()=="" || keywords.val()=="" 
        || conneting_words.val()=="" || special_instructions.val()==""){
        alert('required field must be fill up!');
        order_type.find(".fa-refresh").css("display", "none");
      } else {
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
            action: 'orderCompletion',
            order_id:'<?php echo $orderId; ?>',
            company_name:company_name.val(),
            company_url:company_url.val(),
            blog_topic:blog_topic.val(),
            blog_url:blog_url.val(),
            reference_url:reference_url.val(),
            keywords:keywords.val(),
            conneting_words:conneting_words.val(),
            special_instructions:special_instructions.val(),
            order_type:order_type.val(),
            product_id:product_id.val()
            },
            success: function(data){
              if(order_type.val() == 'complete'){
                $("#"+formId).css("display", "none");
                <?php $incFil = $fill+1; $filupInPer = $filupInDiv*$incFil; ?>
                $('.progress-lenght').html('<?php echo round($filupInPer,2); ?>%');
                $('.progressbar').css('width','<?php echo round($filupInPer,2); ?>%');

              }
              order_type.find(".fa-refresh").css("display", "none");
              $(".alert-success-"+orderId).html("<strong>Success!</strong> Successful "+order_type.val()+".").css("display", "block");
            },
            error: function(errorThrown){
              alert(errorThrown);
            }

            });
        return false;
      }

});
</script>

<?php get_footer(); ?>