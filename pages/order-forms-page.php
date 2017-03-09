<?php
//$array = wc_get_order_statuses();
//print_r($array);

?>
<fieldset style="position: relative;">
<legend><span> Incomplete Forms </span></legend>
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-incompleteForms">
            <option value="">Bulk Actions</option>
            <option value="wc-forms-ready">Forms Ready</option>
            <option value="wc-in-writing-queue">In Writing</option>
            <option value="wc-delivered">Delivered</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-incompleteForms','incompleteForms')" value="Apply">Apply</a>
        <a href="javascript:void(0)" onclick="selectNDeselect(1,'incompleteForms')">Select All</a> -<a href="javascript:void(0)" onclick="selectNDeselect(0,'incompleteForms')">Deselect All</a>
    </div>
</div>
<table id="incompleteForms" class="display order-completion-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>Product/Word count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $filters = array(
        'post_status' => 'wc-on-hold',
        'post_type' => 'shop_order',
        'posts_per_page' => -1,
        'paged' => 1,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $loop = new WP_Query($filters);

    while ($loop->have_posts()) {
        $loop->the_post();
        $order = new WC_Order($loop->post->ID); 
        $orderId = $order->id;
        $order_number = get_post_meta( $orderId, "_order_number", true );
        $pfx_date = get_the_date( 'M d, Y', $orderId );
        $pfx_date_sort = get_the_date( 'Ymd', $orderId );

        $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
        $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
        $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
        ?>

        <tr>
            <td>
            <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
            <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$orderId; ?></a></td>
            <td><span style="display: none;"><?php echo $pfx_date_sort; ?></span><?php echo $pfx_date; ?></td>
            <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
            <td><?php echo $billing_company_name; ?></td>
            <td>
                <?php 
                    foreach( $order->get_items() as $item_id => $item ) {
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
                            $attributes = explode(' - ', $meta_list[0]);
                            $output_attribute = $attributes[0];//implode( $delimiter, $meta_list );
                          }
                        } 

                        $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
                        echo '<strong>'.$productName.'</strong><br/>'.$output_attribute.'<br/>';
                    }
                ?>
            </td>
            <td><a style="text-decoration: none;" href="<?php echo home_url('/order-completion-form/?order_id='.$orderId); ?>" alt="Order Completion Form" target="_blank"><span class="dashicons dashicons-external"></span></a></td>
        </tr>
        <?php         
        }
    ?>
    </tbody>
</table>
</fieldset>

<fieldset style="position: relative;">
<legend><span> Forms Ready </span></legend>
<div class="selectDownload">
    <span class="dashicons dashicons-download"></span>
    <a href="javascript:void(0)" onclick="exportSelected()" alt="Download Selected Forms">Download Selected Forms</a>
</div>
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-formsReady">
            <option value="">Bulk Actions</option>
            <option value="wc-on-hold">Incomplete Forms</option>
            <option value="wc-in-writing-queue">In Writing</option>
            <option value="wc-delivered">Delivered</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-formsReady','formsReady')" value="Apply">Apply</a>
        <a href="javascript:void(0)" onclick="selectNDeselect(1,'formsReady')">Select All</a> -<a href="javascript:void(0)" onclick="selectNDeselect(0,'formsReady')">Deselect All</a>
    </div>
</div>
<table id="formsReady" class="display order-completion-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>Product/Word count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $filters = array(
        'post_status' => 'wc-forms-ready',
        'post_type' => 'shop_order',
        'posts_per_page' => -1,
        'paged' => 1,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $loop = new WP_Query($filters);

    while ($loop->have_posts()) {
        $loop->the_post();
        $order = new WC_Order($loop->post->ID); 
        $orderId = $order->id;
        $order_number = get_post_meta( $orderId, "_order_number", true );
        $pfx_date = get_the_date( 'M d, Y', $orderId );
        $pfx_date_sort = get_the_date( 'Ymd', $orderId );

        $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
        $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
        $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
        ?>

        <tr>
            <td>
            <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
            <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$orderId; ?></a>
            </td>
            <td><span style="display: none;"><?php echo $pfx_date_sort; ?></span><?php echo $pfx_date; ?></td>
            <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
            <td><?php echo $billing_company_name; ?></td>
            <td>
                <?php 
                    foreach( $order->get_items() as $item_id => $item ) {
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
                            $attributes = explode(' - ', $meta_list[0]);
                            $output_attribute = $attributes[0];//implode( $delimiter, $meta_list );
                          }
                        } 

                        $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
                        echo '<strong>'.$productName.'</strong><br/>'.$output_attribute.'<br/>';
                    }
                ?>
            </td>
            <td><a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&export='.$orderId ); ?>" alt="Order Completion Form"><span class="dashicons dashicons-download"></span></a></td>
        </tr>
        <?php         
        }
    ?>
    </tbody>
</table>
</fieldset>

<fieldset style="position: relative;">
<legend><span> In Writing </span></legend>
<div class="selectDownload">
    <span class="dashicons dashicons-download"></span>
    <a href="javascript:void(0)" onclick="exportSelected()" alt="Download Selected Forms">Download Selected Forms</a>
</div>
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-inWriting">
            <option value="">Bulk Actions</option>
            <option value="wc-on-hold">Incomplete Forms</option>
            <option value="wc-forms-ready">Forms Ready</option>                        
            <option value="wc-delivered">Delivered</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-inWriting','inWriting')" value="Apply">Apply</a>
        <a href="javascript:void(0)" onclick="selectNDeselect(1,'inWriting')">Select All</a> -<a href="javascript:void(0)" onclick="selectNDeselect(0,'inWriting')">Deselect All</a>
    </div>
</div>
<table id="inWriting" class="display order-completion-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>Product/Word count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $filters = array(
            'post_status' => 'wc-in-writing-queue',
            'post_type' => 'shop_order',
            'posts_per_page' => -1,
            'paged' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $loop = new WP_Query($filters);
        while ($loop->have_posts()) {
            $loop->the_post();
            $order = new WC_Order($loop->post->ID); 
            $orderId = $order->id;
            $order_number = get_post_meta( $orderId, "_order_number", true );
            $pfx_date = get_the_date( 'M d, Y', $orderId );
            $pfx_date_sort = get_the_date( 'Ymd', $orderId );

            $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
            $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
            $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
            ?>

            <tr>
                <td>
                <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
                <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$orderId; ?></a></td>
                <td><span style="display: none;"><?php echo $pfx_date_sort; ?></span><?php echo $pfx_date; ?></td>
                <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
                <td><?php echo $billing_company_name; ?></td>
                <td>
                    <?php 
                    foreach( $order->get_items() as $item_id => $item ) {
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
                            $attributes = explode(' - ', $meta_list[0]);
                            $output_attribute = $attributes[0];//implode( $delimiter, $meta_list );
                          }
                        } 

                        $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
                        echo '<strong>'.$productName.'</strong><br/>'.$output_attribute.'<br/>';
                    }
                ?>
                </td>
                <td><a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&export='.$orderId ); ?>" alt="Order Completion Form"><span class="dashicons dashicons-download"></span></a></td>
            </tr>
            <?php         
            }
        ?>
    </tbody>
</table>
</fieldset>

<fieldset  style="position: relative;">
<legend><span> Delivered </span></legend>
<div class="selectDownload">
    <span class="dashicons dashicons-download"></span>
    <a href="javascript:void(0)" onclick="exportSelected()" alt="Download Selected Forms">Download Selected Forms</a>
</div>
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-delivered">
            <option value="">Bulk Actions</option>
            <option value="wc-forms-ready">Forms Ready</option>
            <option value="wc-on-hold">Incomplete Forms</option>            
            <option value="wc-in-writing-queue">In Writing</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-delivered','delivered')" value="Apply">Apply</a>
        <a href="javascript:void(0)" onclick="selectNDeselect(1,'delivered')">Select All</a> -<a href="javascript:void(0)" onclick="selectNDeselect(0,'delivered')">Deselect All</a>
    </div>
</div>
<table id="delivered" class="display order-completion-table" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Order #</th>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>Product/Word count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $filters = array(
            'post_status' => 'wc-delivered',
            'post_type' => 'shop_order',
            'posts_per_page' => -1,
            'paged' => 1,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $loop = new WP_Query($filters);
        while ($loop->have_posts()) {
            $loop->the_post();
            $order = new WC_Order($loop->post->ID); 
            $orderId = $order->id;
            $order_number = get_post_meta( $orderId, "_order_number", true );
            $pfx_date = get_the_date( 'M d, Y', $orderId );
            $pfx_date_sort = get_the_date( 'Ymd', $orderId );

            $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
            $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
            $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
            ?>
            <tr>
                <td>
                <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
                <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$orderId; ?></a></td>
                <td><span style="display: none;"><?php echo $pfx_date_sort; ?></span><?php echo $pfx_date; ?></td>
                <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
                <td><?php echo $billing_company_name; ?></td>
                <td>
                    <?php 
                    foreach( $order->get_items() as $item_id => $item ) {
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
                            $attributes = explode(' - ', $meta_list[0]);
                            $output_attribute = $attributes[0];//implode( $delimiter, $meta_list );
                          }
                        } 

                        $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
                        echo '<strong>'.$productName.'</strong><br/>'.$output_attribute.'<br/>';
                    }
                ?>
                </td>
                <td><a style="text-decoration: none;" href="<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&export='.$orderId ); ?>" alt="Order Completion Form"><span class="dashicons dashicons-download"></span></a></td>
            </tr>
            <?php         
            }
        ?>
    </tbody>
</table>
</fieldset>

<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>order-forms-page.css" />
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    function selectNDeselect(source,formId) {
      checkboxes = $("#"+formId).find("[name='readyForms[]']");
      if(source==1) { var chkStatus = true; } else { var chkStatus = false; }
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = chkStatus;             
      }
    }

    function exportSelected() {
        var checkedboxesCount = $("#formsReady input[name='readyForms[]']:checked").length;
        if(checkedboxesCount < 1){
            alert('Select checkbox for further action!');
        } else {
            //var checkboxesaa = document.querySelectorAll('input[name="readyForms[]"]:checked');
            var checkboxesaa = $("#formsReady input[name='readyForms[]']:checked");
            var getSelected = [];
            for(var i=0, n=checkboxesaa.length;i<n;i++) {           
                getSelected.push(checkboxesaa[i].value);        
            }
            window.location.href = "<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&multiple=1&export='); ?>"+getSelected;

        }
       return false;
    }

    function bulkAction(selId,tableId){

        var checkedboxesCount = $("#"+tableId+" input[name='readyForms[]']:checked").length;
        if(checkedboxesCount < 1){
            alert('Select checkbox for further action!');
        } else {
            var bulkActionSel = document.getElementById(selId).value;
            var checkboxesaa = $("#"+tableId+" input[name='readyForms[]']:checked");
            var getSelected = [];
            for(var i=0, n=checkboxesaa.length;i<n;i++) {           
                getSelected.push(checkboxesaa[i].value);        
            }
            window.location.href = "<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&change_to='); ?>"+bulkActionSel+'&change_for='+getSelected;
        }

        return false;
    }

	$(document).ready(function(){
	    $('#incompleteForms, #formsReady, #inWriting, #delivered').DataTable({
	        "order": [[ 1, "desc" ]]
	    });
	});
</script>
