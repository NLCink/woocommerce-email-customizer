<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}", true );
  if(!empty($get_order_id)){
    $company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}", true );
    $current_website = get_post_meta( $orderId, "_comp_current_website_{$productID}", true );   
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
    $company_name = '';
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
      <p>Example:<br> companysite.com</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="current_website" value="<?php echo $current_website; ?>" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">City and State</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Enter the City and State that this press release will be based from</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="city_state" value="<?php echo $city_state; ?>" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Day, Month and Year</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Enter the estimated day, month and year when this press release will be posted</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="day_month_year" value="<?php echo $day_month_year; ?>" placeholder="(If there is an actual event taking place)" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Physical address</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Enter the phyiscal address that this press release will be based from</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="physical_address" value="<?php echo $physical_address; ?>" placeholder="(If there is an actual event taking place)" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Time of day</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Enter the estimated time that this press release will be submitted</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="time_day" value="<?php echo $time_day; ?>" placeholder="(If there is an actual event taking place)" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Reference URLs</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p><strong>Example</strong><br>
        http://example.com</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="reference_url" value="<?php echo $reference_url; ?>" type="text">
  <button class="btn-add-more"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon"></button>
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Keywords (up to 3)</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p><strong>Example</strong><br>
        plumbing in SLC, emergency plumbing services</p>
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
      <p><strong>Example</strong><br>Connecting words are words such as “in”, “for”, or “around”.  These words help make keywords easier to read or grammatically correct.   For example, if your keyword was “plumbing SLC”, then including connecting words would allow a writer to insert the keyword in the article as “plumbing in SLC”.</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs" name="connecting_words" value="<?php echo $connecting_words; ?>" type="text">
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Relevant Quotes</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p><strong>Example</strong><br>
"We know that plumbing emergencies don't always happen at convenient times.  That's why we've decided to add emergency plumbing services to help cover those incidents that happen on weekends, holidays and at night.  We are committed to the satisfaction and safety of our customers." - Joe Smith, CEO of Joe's Plumbing</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <textarea class="order-form-inputs" name="relevant_quotes" rows="8" cols="80" placeholder="(Include quotes from peaple/executives close to the sitiation. Please include person's name and title/occupation)"><?php echo $relevant_quotes; ?></textarea>
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Boilerplate</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p><strong>Example</strong><br>Give us a few sentences that highlight important details about your company.  Or, give us a link to your "About Us" page and we'll formulate one.  This section can stay the exact same for all releases.
<br>
Founded in 1974, Joe's Plumbing is a full-service plumbing and drain cleaning company in the Salt Lake City area that is devoted to plumbing excellence.  Recognized by Good Things Utah as "Utah's best plumber", Joe's Plumbing offers both residential and commercial services at affordable prices.  For more information, please visit http://example.com.</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <textarea class="order-form-inputs" name="boilerplate" rows="8" cols="80" placeholder="(This is the 'About Us' section of the release)"><?php echo $boilerplate; ?></textarea>
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">What's the News?</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p><strong>Example:</strong><br>
We've just expanded our services list to include 24 hour emergency services to Salt Lake City residents.  We now offer 24 hour services to all surrounding cities as well (From Ogden down to Provo).  There is no additional fee for this.  Trucks come fully stocked so all repairs can be made on the first visit.  See URL for more details on exactly how the service works. We can be contacted at 999-999-9999.</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <textarea class="order-form-inputs" name="news" rows="8" cols="80" placeholder="(Give us detailed information about what's being announced. Answer who, what, when, where and why. Include any details, statistics, dates or other relevant information)"><?php echo $news; ?></textarea>
</div>
</div>