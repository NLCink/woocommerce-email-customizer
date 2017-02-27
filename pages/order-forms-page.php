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
        'posts_per_page' => 200,
        'paged' => 1,
        'orderby' => 'modified',
        'order' => 'ASC'
    );

    $loop = new WP_Query($filters);

    while ($loop->have_posts()) {
        $loop->the_post();
        $order = new WC_Order($loop->post->ID); 
        $orderId = $order->id;
        $order_number = get_post_meta( $orderId, "_order_number", true );
        $pfx_date = get_the_date( 'M d, Y', $orderId );

        $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
        $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
        $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
        ?>

        <tr>
            <td>
            <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
            <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
            <td><?php echo $pfx_date; ?></td>
            <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
            <td><?php echo $billing_company_name; ?></td>
            <td>-</td>
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
        'posts_per_page' => 200,
        'paged' => 1,
        'orderby' => 'modified',
        'order' => 'ASC'
    );

    $loop = new WP_Query($filters);

    while ($loop->have_posts()) {
        $loop->the_post();
        $order = new WC_Order($loop->post->ID); 
        $orderId = $order->id;
        $order_number = get_post_meta( $orderId, "_order_number", true );
        $pfx_date = get_the_date( 'M d, Y', $orderId );

        $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
        $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
        $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
        ?>

        <tr>
            <td>
            <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
            <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a>
            </td>
            <td><?php echo $pfx_date; ?></td>
            <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
            <td><?php echo $billing_company_name; ?></td>
            <td>-</td>
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
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-inWriting">
            <option value="">Bulk Actions</option>
            <option value="wc-on-hold">Incomplete Forms</option>
            <option value="wc-forms-ready">Forms Ready</option>                        
            <option value="wc-delivered">Delivered</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-inWriting','inWriting')" value="Apply">Apply</a>
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
            'posts_per_page' => 200,
            'paged' => 1,
            'orderby' => 'modified',
            'order' => 'ASC'
        );
        $loop = new WP_Query($filters);
        while ($loop->have_posts()) {
            $loop->the_post();
            $order = new WC_Order($loop->post->ID); 
            $orderId = $order->id;
            $order_number = get_post_meta( $orderId, "_order_number", true );
            $pfx_date = get_the_date( 'M d, Y', $orderId );

            $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
            $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
            $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
            ?>

            <tr>
                <td>
                <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
                <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
                <td><?php echo $pfx_date; ?></td>
                <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
                <td><?php echo $billing_company_name; ?></td>
                <td>-</td>
                <td><a style="text-decoration: none;" href="<?php echo home_url('/order-completion-form/?order_id='.$orderId); ?>" alt="Order Completion Form" target="_blank"><span class="dashicons dashicons-external"></span></a></td>
            </tr>
            <?php         
            }
        ?>
    </tbody>
</table>
</fieldset>

<fieldset  style="position: relative;">
<legend><span> Delivered </span></legend>
<div class="top tablePrivate">    
    <div class="alignleft actions bulkactions">                                             
        <select name="action" id="bulk-action-delivered">
            <option value="">Bulk Actions</option>
            <option value="wc-forms-ready">Forms Ready</option>
            <option value="wc-on-hold">Incomplete Forms</option>            
            <option value="wc-in-writing-queue">In Writing</option>
        </select>
        <a class="button action" onClick="bulkAction('bulk-action-delivered','delivered')" value="Apply">Apply</a>
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
            'posts_per_page' => 200,
            'paged' => 1,
            'orderby' => 'modified',
            'order' => 'ASC'
        );
        $loop = new WP_Query($filters);
        while ($loop->have_posts()) {
            $loop->the_post();
            $order = new WC_Order($loop->post->ID); 
            $orderId = $order->id;
            $order_number = get_post_meta( $orderId, "_order_number", true );
            $pfx_date = get_the_date( 'M d, Y', $orderId );

            $billing_first_name = get_post_meta( $orderId, "_billing_first_name", true );
            $billing_last_name = get_post_meta( $orderId, "_billing_last_name", true );
            $billing_company_name = get_post_meta( $orderId, "_billing_company", true );
            ?>
            <tr>
                <td>
                <input type="checkbox" name="readyForms[]" value="<?php echo $orderId; ?>">
                <a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
                <td><?php echo $pfx_date; ?></td>
                <td><?php echo $billing_first_name.' '.$billing_last_name; ?></td>
                <td><?php echo $billing_company_name; ?></td>
                <td>-</td>
                <td><a style="text-decoration: none;" href="<?php echo home_url('/order-completion-form/?order_id='.$orderId); ?>" alt="Order Completion Form" target="_blank"><span class="dashicons dashicons-external"></span></a></td>
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
            window.open("<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&multiple=1&export='); ?>"+getSelected,'_blank');
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
