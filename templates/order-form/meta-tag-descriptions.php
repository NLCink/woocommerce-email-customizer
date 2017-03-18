<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $page_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}-{$q}", true );
    $primary_keyword = get_post_meta( $orderId, "_comp_primary_keyword_{$productID}-{$q}", true );
    $secondary_keyword = get_post_meta( $orderId, "_comp_secondary_keyword_{$productID}-{$q}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );    
  } else {
    $reference_url = '';
    $primary_keyword = '';
    $secondary_keyword = '';
    $special_instructions = '';
  }
?>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Page URL</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>This is the page we will write the description for.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="page_url" value="<?php echo $page_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Primary Keyword</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
diamond wedding ring</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="primary_keyword" value="<?php echo $primary_keyword; ?>" type="text">
  </div>
</div>
<div class="order-form-full" id="cloneKeywordSecDiv-<?php echo $q; ?>">
  <div class="order-form-left">
    <h5 class="order-form-label">Secondary Keyword</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          Salt Lake City, UT</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="secondary_keyword" value="<?php echo $secondary_keyword; ?>" type="text">
    <!-- <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeywordSecDiv-<?php echo $q; ?>','cloneKeywordSecDivAdd-<?php //echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a> -->
  </div>
</div>
<!-- <div id="cloneKeywordSecDivAdd-<?php /* echo $q; ?>">
    <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_secondary_keyword-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeywordSecDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Primary Keyword</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p><strong>Example:</strong><br>
      diamond wedding ring</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs" name="secondary_keyword-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeywordSecDivAdd-<?php echo $q; ?>','rowCount-cloneKeywordSecDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } */?>
</div> -->
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Include information about the desired tone/style, target audience, and any specific things you’d like mentioned in the content.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs not_required" name="special_instructions" rows="8" cols="80" placeholder="Insert the general guidelines for this content, if any"><?php echo $special_instructions; ?></textarea>
  </div>
</div>