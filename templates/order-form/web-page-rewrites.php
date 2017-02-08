<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}", true );
    $current_website = get_post_meta( $orderId, "_comp_current_website_{$productID}", true );
    $url_needing_rewritten = get_post_meta( $orderId, "_comp_url_needing_rewritten_{$productID}", true );
    $page_name = get_post_meta( $orderId, "_comp_page_name_{$productID}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}", true );
    $connecting_words = get_post_meta( $orderId, "_comp_connecting_words_{$productID}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}", true );
  } else {
    $company_name = '';
    $current_website = '';
    $url_needing_rewritten = '';
    $page_name = '';
    $keywords = '';
    $connecting_words = '';
    $special_instructions = '';
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
    <input class="order-form-inputs" name="company_name" value="<?php echo $company_name; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Current Website</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Example:<br>companysite.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="current_website" value="<?php echo $current_website; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">URL Needing to be Rewritten</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          http://example.com</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="url_needing_rewritten" value="<?php echo $url_needing_rewritten; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Page Name</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Examples:</strong><br>
          AC Repair in SLC</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="page_name" value="<?php echo $page_name; ?>" type="text">
    <button class="btn-add-more"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon"></button>
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Keywords (up to 3)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
air conditioners in SLC, AC repair in SLC</p>
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
    <h5 class="order-form-label">Connecting Words</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Connecting words are words such as “in”, “for”, or “around”. These words help make keywords easier to read or grammatically correct. For example, if your keyword was “plumbing SLC”, then including connecting words would allow a writer to insert the keyword in the article as “plumbing in SLC”.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="connecting_words" value="<?php echo $connecting_words; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
These URLs have duplicate content. We just need each page rewritten so that it is completely original and unique.  Make sure each page is optimized for the GEO location listed in the page name. Include the keywords 3 times each per page.  Include a call to action with our phone #.<br>
<strong>Example:</strong>
Make sure to include a bulleted list of the AC Units that we carry somewhere on the page.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs" name="special_instructions" rows="8" cols="80" placeholder="Insert general guidelines for this branded blog post"><?php echo $special_instructions; ?></textarea>
  </div>
</div>