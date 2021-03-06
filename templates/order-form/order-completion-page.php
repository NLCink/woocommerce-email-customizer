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
          <h2 class="progress-title">Your Progress <span class="progress-lenght">0%</span></h2>
          <div class="progress-container">
            <div class="progressbar" style="width:0%"></div>
          </div>
          <?php 
             $get_status = get_post_meta( $orderId, "_comp_status_{$orderId}-1", true );
            if($get_status < 95){
          ?>
          <h3 class="order-form-titie formCompleteTitle">Please complete the form(s) below to complete your order</h3>
          <?php } ?>

            <?php
            $inc=1;
            $tot=0;
            $fill=0;
            $duplicate_status = 1;
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

            
             $get_product_id = $item['product_id'];
             $post_product = get_post($get_product_id); 
             $slug_product = $post_product->post_name;
             $productName = apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );

             $allProductDes[] = $productName.' - '.$output_attribute;
            for($q=1;$q<=$item['qty'];$q++){

            $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
            if(!empty($get_order_id)){
              $get_order_type = get_post_meta( $orderId, "_comp_order_type_{$productID}-{$q}", true );              
            } else {
              $get_order_type = '';
            }
            ?>

          <div class="divider"></div>

          <h3 class="form-name">Form <?php echo $inc; ?> 
          <?php if($q > 1 && $duplicate_status == 1) { $cloneFrom = $q-1; ?>
          <div class="clonAboveForm"><a onclick="duplicatAbove('orderForm-<?php echo $productID.'-'.$cloneFrom; ?>','orderForm-<?php echo $productID.'-'.$q; ?>')" href="javascript:void(0)" title="Duplicate above data to this form">Duplicate above data to this form</a></div>
          <?php } ?>
          </h3>

          <div class="word-wrap">
            <h3 class="word-count">Product: <?php 
              echo $productName;
              if($item['qty'] >1 ){
                echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', 1 ) . '</strong>', $item );
              } else {
                echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );
              }
              echo ' - ';
              echo $output_attribute; ?></h3>
            <a href="#" class="btn-order-clear">Demo</a>
          </div>
          <div class="form-wrap area">
            <div class="alert alert-success alert-success-<?php echo $productID.'-'.$q; ?>" style="display: none;">
            <strong>Success!</strong> Indicates a successful or positive action.
          </div>
          <?php if(!empty($get_order_type) && $get_order_type == 'complete') { $duplicate_status=0; $fill++; ?>
          <div class="form-wrap area">
            <div class="alert alert-success alert-success-<?php echo $productID.'-'.$q; ?> completeForms">
            <strong>Success!</strong> You have successfully completed this form.
          </div>
          <?php } else { $duplicate_status=1; ?>
            <form class="order-form area orderForm-<?php echo $productID.'-'.$q; ?>" id="orderForm-<?php echo $productID.'-'.$q; ?>" data-order-id="<?php echo $productID.'-'.$q; ?>" action="#" method="post">
            <input type="hidden" name="product_id" value="<?php echo $productID.'-'.$q; ?>">
            <input type="hidden" name="action" value="orderCompletion">
            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
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
                echo 'This product is invalide for this order complition form! Please contact with it help desk.';
              }
              

              ?>
              <div class="word-wrap">            
                <button type="submit" name="order_type" class="btn-order-fill" value="save">
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
                $("#orderForm-<?php echo $productID.'-'.$q; ?>").validate();
              });
            </script>

          </div>
        <?php
            $inc++;
            $tot++;
        }
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
function duplicatAbove(cloneFrom,cloneTo){
  var allFormField = $('#' + cloneFrom).find('input:not([type=hidden]), textarea, select');
        var values = {};
        allFormField.each(function () {
            values[this.name] = $(this).val();
            $('#' + cloneTo).find('[name='+this.name+']').val($(this).val());
        });
        console.log(values);
}
function addNewItem(cloneThisDiv,cloneThisDivAdd,maxinput=0){
    var x = document.getElementById(cloneThisDiv).cloneNode(true);
    x.id = "";
    x.style.display = "";

    var rowCount = $('#' + cloneThisDivAdd).find('input').length;
    if(rowCount >= maxinput){
      alert('Maximum input exceed!');
      return false;
    }
    var lastTr = $('#' + cloneThisDivAdd).find('.order-form-full').last().attr('data-number');
    //var production_desc_val = $('#' + tableID).find('tr').last().find('.production_desc_1st').val();
    if (lastTr != '' && typeof lastTr !== "undefined"){
        rowCount = parseInt(lastTr) + 1;
    }
    //Increment id
    var rowCo = rowCount+2;
    var idText = 'rowCount-'+cloneThisDiv + '-' +rowCount;
    x.id = idText;

    $("#" + cloneThisDivAdd).append(x);
    $("#"+cloneThisDivAdd).find('.order-form-left').css('visibility','hidden');
    $("#"+cloneThisDivAdd).find('#' + idText).find('.btn-add-more').html('<i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i>').removeClass('btn-primary').addClass('btn-danger').attr('onclick', 'removeItem("'+cloneThisDivAdd+'","' + idText + '")');
    $('#' + cloneThisDivAdd).find('#'+idText).attr('data-number', rowCount);

    //get input elements
    var attrInput = $("#" + cloneThisDivAdd).find('#' + idText).find('input');
    for (var i = 0; i < attrInput.length; i++){
        var nameAtt = attrInput[i].name;
        //increment all array element name
        var repText = nameAtt.replace('1', rowCo);
        attrInput[i].name = repText;
    }
    attrInput.val(''); //value reset

    return false;
}

function removeItem(cloneThisDivAdd,removeNum){
  $('#' + cloneThisDivAdd).find('#' + removeNum).remove();
}

$(document).ready(function(){
  $('.order-form').find('input:not(.not_required), select:not(.not_required), textarea:not(.not_required)').addClass('required');
  var progressbarr = Math.round('<?php echo $filupInPer; ?>');
  $('.progress-lenght').html(progressbarr+'%');
  $('.progressbar').css('width',progressbarr+'%');
  $('.allProductDes').html('<?php echo $allProductD; ?>');
});
$(document).on("click", ":submit", function(e) {
    var order_type = $(this);
    var orderId = order_type.closest("form").attr('data-order-id');
    var formId = order_type.closest("form").attr('id');
    if(order_type.val() == 'complete'){
      var formValid = $("#" + formId).valid();
    } else {
      var formValid = true;
    }
    

    if (formValid !== false){
        order_type.find(".fa-refresh").css("display", "inline-block");
        var product_id = $('#' + formId).find("input[name=product_id]");

        /*var company_name = $('#'+formId).find("input[name=company_name]");
         var company_url = $('#'+formId).find("input[name=company_url]");
         var blog_topic = $('#'+formId).find("input[name=blog_topic]");
         var blog_url = $('#'+formId).find("input[name=blog_url]");
         var reference_url = $('#'+formId).find("input[name=reference_url]");
         var keywords = $('#'+formId).find("input[name=keywords]");
         var conneting_words = $('#'+formId).find("input[name=conneting_words]");
         var special_instructions = $('#'+formId).find("textarea[name=special_instructions]");

         product_id:product_id.val(),
         company_name:company_name.val(),
         company_url:company_url.val(),
         blog_topic:blog_topic.val(),
         blog_url:blog_url.val(),
         reference_url:reference_url.val(),
         keywords:keywords.val(),
         conneting_words:conneting_words.val(),
         special_instructions:special_instructions.val(),
         order_type:order_type.val()
         */

        var allFormField = $('#' + formId).find('input, textarea, select');
        var values = {};
        allFormField.each(function () {
            values[this.name] = $(this).val();
        });
        values['order_type'] = order_type.val();
        var totalForms = '<?php echo $tot; ?>';
        values['total_forms'] = totalForms;
        var completeForm = $('.completeForms').length + 1;
        values['total_complete_forms'] = completeForm;
        var filupInDiv = (100/totalForms);
        var filupInPer = filupInDiv*completeForm;
        var progressLength = Math.round(filupInPer);
        values['progressLength'] = progressLength;
        //console.log(values);
        //return false;

        if (values.length === 0) {
            alert('required field must be fill up!');
            order_type.find(".fa-refresh").css("display", "none");
        } else {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: values,
                success: function (data) {
                    if (order_type.val() == 'complete') {
                        $("#" + formId).css("display", "none");
                        
                        $('.progress-lenght').html(progressLength+'%');
                        $('.progressbar').css('width', progressLength+'%');

                    }
                    order_type.find(".fa-refresh").css("display", "none");
                    if(order_type.val()=='save'){
                      var success_class = 'saveForms';
                      var saveMsg = 'You have successfully saved this form.';
                    } else {
                      var success_class = 'completeForms';
                      var saveMsg = 'You have successfully completed this form.';
                    }
                    $(".alert-success-" + orderId).html("<strong>Success!</strong> " + saveMsg).css("display", "block").addClass(success_class);

                    if(progressLength > 95){
                      $('.formCompleteTitle').css("display", "none");
                    }

                },
                error: function (errorThrown) {
                    alert(errorThrown);
                }

            });
            return false;
        }
    }
});
</script>

<?php get_footer(); ?>