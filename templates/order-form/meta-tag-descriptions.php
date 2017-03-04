<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}", true );
    $primary_keyword = get_post_meta( $orderId, "_comp_primary_keyword_{$productID}", true );
    $secondary_keyword = get_post_meta( $orderId, "_comp_secondary_keyword_{$productID}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}", true );    
  } else {
    $reference_url = '';
    $primary_keyword = '';
    $secondary_keyword = '';
    $special_instructions = '';
  }
?>
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
    <input class="order-form-inputs" name="primary_keyword" value="<?php echo $primary_keyword; ?>" type="text">
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
    <input class="order-form-inputs" name="secondary_keyword-1" value="<?php echo $secondary_keyword; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeywordSecDiv-<?php echo $q; ?>','cloneKeywordSecDivAdd-<?php echo $q; ?>')"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id=cloneKeywordSecDivAdd-<?php echo $q; ?>"></div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          These are meta tags for product pages. Mention the primary keyword once. Mention primary keyword wtihin the first few words of the first sentence if possible. Quickly describe the product in an enticing way, and tie it into our company if you can. </p>
        <p>Mention that this ring is completely hand set.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs" name="special_instructions" rows="8" cols="80" placeholder="Meta Description Special Instructions"><?php echo $special_instructions; ?></textarea>
  </div>
</div>