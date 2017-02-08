<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $social_media_type = get_post_meta( $orderId, "_comp_social_media_type_{$productID}", true );
    $web_url = get_post_meta( $orderId, "_comp_web_url_{$productID}", true );   

    $city_state = get_post_meta( $orderId, "_comp_city_state_{$productID}", true );
    $day_month_year = get_post_meta( $orderId, "_comp_day_month_year_{$productID}", true );
    $physical_address = get_post_meta( $orderId, "_comp_physical_address_{$productID}", true );
    $time_day = get_post_meta( $orderId, "_comp_time_day_{$productID}", true );
    $reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}", true );
    $connecting_words = get_post_meta( $orderId, "_comp_connecting_words_{$productID}", true );
    $relevant_quotes = get_post_meta( $orderId, "_comp_relevant_quotes_{$productID}", true );
    $boilerplate = get_post_meta( $orderId, "_comp_boilerplate_{$productID}", true );    
    $news = get_post_meta( $orderId, "_comp_news_{$productID}", true );
  } else {
    $social_media_type = '';
    $web_url = '';

    $current_website = '';
    $city_state = '';
    $day_month_year = '';
    $physical_address = '';
    $time_day = '';
    $reference_url = '';
    $keywords = '';
    $connecting_words = '';
    $relevant_quotes = '';
    $boilerplate = '';
    $news = '';
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
    <input class="order-form-inputs" name="social_media_type" value="<?php echo $social_media_type; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">URL</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
http://example.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="web_url" value="<?php echo $web_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Subject (if no link provided)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Movies</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="" value="" type="text">
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
    <input class="order-form-inputs" name="" value="" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          I want 30 tweets around the subject of Disney movies. Include a link to the story you find.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs" name="name" rows="8" cols="80" placeholder="Meta Description Special Instructions"></textarea>
  </div>
</div>