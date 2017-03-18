<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $social_media_type = get_post_meta( $orderId, "_comp_social_media_type_{$productID}-{$q}", true );
    $web_url = get_post_meta( $orderId, "_comp_web_url_{$productID}-{$q}", true );   
    $subject = get_post_meta( $orderId, "_comp_subject_{$productID}-{$q}", true );
    $hashtags = get_post_meta( $orderId, "_comp_hashtags_{$productID}-{$q}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );
  } else {
    $social_media_type = '';
    $web_url = '';
    $subject = '';
    $hashtags = '';
    $special_instructions = '';
  }
?>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Social Media Type</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Twitter</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="social_media_type" value="<?php echo $social_media_type; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">URL</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Page we are writing a social media post for.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="web_url" value="<?php echo $web_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Subject</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Movies</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="subject" value="<?php echo $subject; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Hashtags</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          #Disney</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="hashtags" value="<?php echo $hashtags; ?>" type="text">
  </div>
</div>
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