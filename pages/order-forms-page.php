<?php
//$array = wc_get_order_statuses();
//print_r($array);

?>
<fieldset>
<legend><span> Incomplete Forms </span></legend>
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
            <td><a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
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

<fieldset>
<legend><span> Forms Ready </span></legend>
<div style="margin:-22px 0 10px"><a href="javascript:void(0)" onclick="exportSelected()" alt="Download Selected Forms">Download Selected Forms</a></div>
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

<fieldset>
<legend><span> In Writing </span></legend>
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
                <td><a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
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

<fieldset>
<legend><span> Delivered </span></legend>
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
                <td><a href="<?php echo admin_url( 'post.php?post='.$orderId.'&action=edit' ); ?>"><?php echo '#'.$order_number; ?></a></td>
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

<style type="text/css">
    fieldset {
        padding: 10px;
        margin-bottom: 15px;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border: 2px solid #AAA5A2;
    }

    legend {
        display: block;
        padding: 0;
        margin-bottom: 20px;
        font-size: 14px;
        line-height: inherit;
        color: #333;
        font-weight: bold;
    }

    .order-completion-table.dataTable > thead > tr {
        background-color: #C5E3F0;
        color: #333;
    }

    .order-completion-table.dataTable > thead > tr > th {
        text-align: left;
        padding-left: 11px;
        border-top: 1px solid #333;
    }    

    .order-completion-table.dataTable > tbody > tr:nth-of-type(odd) {
        background-color: #eee;
    }

    .order-completion-table > tbody > tr > td, .table-striped > tbody > tr > th {
        padding: 1px 5px;
        border: 1px dotted #ddd;
        text-align: left;
    }

    .order-completion-table{

    }

</style>

<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/css/jquery.dataTables.min.css" />
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo plugin_dir_url( __FILE__ ); ?>../assets/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    function exportSelected() {
        var checkedboxesCount = document.querySelectorAll('input[name="readyForms[]"]:checked').length;
        if(checkedboxesCount < 1){
            alert('Select checkbox for further action!');
        } else {
            var checkboxesaa = document.querySelectorAll('input[name="readyForms[]"]:checked');
            var getSelected = [];
            for(var i=0, n=checkboxesaa.length;i<n;i++) {           
                getSelected.push(checkboxesaa[i].value);        
            }
            console.log(getSelected);
            window.open("<?php echo admin_url( 'admin.php?page=woocommerce_order_forms&multiple=1&export='); ?>"+getSelected,'_blank');
        }
       return false;
    }
	$(document).ready(function(){
	    $('#incompleteForms, #formsReady, #inWriting, #delivered').DataTable({
	        "order": [[ 1, "desc" ]]
	    });
	});
</script>