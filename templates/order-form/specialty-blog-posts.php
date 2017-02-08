<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $get_company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}", true );
    $get_company_url = get_post_meta( $orderId, "_comp_company_url_{$productID}", true );
    $get_blog_topic = get_post_meta( $orderId, "_comp_blog_topic_{$productID}", true );
    $get_blog_url = get_post_meta( $orderId, "_comp_blog_url_{$productID}", true );
    $get_reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}", true );
    $get_keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}", true );
    $get_conneting_words = get_post_meta( $orderId, "_comp_conneting_words_{$productID}", true );
    $get_special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}", true );    
  } else {
    $get_company_name = '';
    $get_company_url = '';
    $get_blog_topic = '';
    $get_blog_url = '';
    $get_reference_url = '';
    $get_keywords = '';
    $get_conneting_words = '';
    $get_special_instructions = '';
  }
?>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Full Company Name</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Enter your company name here</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="company_name" value="<?php echo $get_company_name; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Current Website</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br> companysite.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="company_url" value="<?php echo $get_company_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Blog Topic</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br> Interior Design Trends</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="blog_topic" value="<?php echo $get_blog_topic; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Examples Blog URLs</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br> http://example.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="blog_url" value="<?php echo $get_blog_url; ?>" type="text">
    <button class="btn-add-more"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon"></button>
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Reference URL</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Please include URLs of blogs that you would like us to try and emulate.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="reference_url" value="<?php echo $get_reference_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Keywords (up to 3)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br>"plumbing SLC"</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="keywords" value="<?php echo $get_keywords; ?>" type="text">
    <button class="btn-add-more"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon"></button>
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Conneting words</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Connecting words are words such as “in”, “for”, or “around”. These words help make keywords easier to read or grammatically correct. For example, if your keyword was “plumbing SLC”, then including connecting words would allow a writer to insert the keyword in the article as “plumbing in SLC”</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs required" name="conneting_words" value="<?php echo $get_conneting_words; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br> Please mention the company name in the first and last paragraph. Also include a small call to action at the end of the blog telling the reader to contact us. Make the blogs educational, seasonal, fun and reflective of our company voice. Top 3, 5 or 10 item lists are preferred for these.<br>
Example:<br> List some of the most popular trends in the industry right now and situations where they would apply</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs required" name="special_instructions" rows="8" cols="80" placeholder="( Insert general guidelines for this branded blog post )"><?php echo $get_special_instructions; ?></textarea>
  </div>
</div>