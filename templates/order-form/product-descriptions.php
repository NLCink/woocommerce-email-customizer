<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $product_name = get_post_meta( $orderId, "_comp_product_name_{$productID}", true );
    $reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}", true );
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
<div class="order-form-full">
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
    <input class="order-form-inputs" name="keywords" value="<?php echo $keywords; ?>" type="text">
    <button class="btn-add-more"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon"></button>
  </div>
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
    <textarea class="order-form-inputs" name="special_instructions" rows="8" cols="80" placeholder="Insert general guidelines for this branded blog post"><?php echo $special_instructions; ?></textarea>
  </div>
</div>