<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $product_name = get_post_meta( $orderId, "_comp_product_name_{$productID}-{$q}", true );
    $reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}-{$q}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords-1_{$productID}-{$q}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );
  } else {
    $product_name = '';
    $reference_url = '';
    $keywords = '';
    $special_instructions = '';
  }
?>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Product Name</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          Tarzan wall decal</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="product_name" value="<?php echo $product_name; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Reference URL</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
http://example.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="reference_url" value="<?php echo $reference_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full" id="cloneKeyPreDesDiv-<?php echo $q; ?>">
  <div class="order-form-left">
    <h5 class="order-form-label">Keywords (up to 3)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Disney</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="keywords-1" value="<?php echo $keywords; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeyPreDesDiv-<?php echo $q; ?>','cloneKeyPreDesDivAdd-<?php echo $q; ?>',3)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="cloneKeyPreDesDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_keywords-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeyPreDesDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Keywords (up to 3)</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p><strong>Example:</strong><br>
      Disney</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs" name="keywords-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeyPreDesDivAdd-<?php echo $q; ?>','rowCount-cloneKeyPreDesDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Include the primary keyword in the first sentence of the first paragraph. These should be more informal, so make them fun and full of personality.<br>
<strong>Example:</strong><br>
Talk about the dimensions of the decal and how it would look great in any kids room. </p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs" name="special_instructions" rows="8" cols="80" placeholder="Insert general guidelines (optional)"><?php echo $special_instructions; ?></textarea>
  </div>
</div>