<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}-{$q}", true );
    $current_website = get_post_meta( $orderId, "_comp_current_website_{$productID}-{$q}", true );   
    $city_state = get_post_meta( $orderId, "_comp_city_state_{$productID}-{$q}", true );
    $day_month_year = get_post_meta( $orderId, "_comp_day_month_year_{$productID}-{$q}", true );
    $physical_address = get_post_meta( $orderId, "_comp_physical_address_{$productID}-{$q}", true );
    $time_day = get_post_meta( $orderId, "_comp_time_day_{$productID}-{$q}", true );
    $reference_url = get_post_meta( $orderId, "_comp_reference_url-1_{$productID}-{$q}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}-{$q}", true );
    $headline = get_post_meta( $orderId, "_comp_headline_{$productID}-{$q}", true );
    //$connecting_words = get_post_meta( $orderId, "_comp_connecting_words_{$productID}-{$q}", true );
    $relevant_quotes = get_post_meta( $orderId, "_comp_relevant_quotes_{$productID}-{$q}", true );
    $boilerplate = get_post_meta( $orderId, "_comp_boilerplate_{$productID}-{$q}", true );    
    $news = get_post_meta( $orderId, "_comp_news_{$productID}-{$q}", true );
  } else {
    $company_name = '';
    $current_website = '';
    $city_state = '';
    $day_month_year = '';
    $physical_address = '';
    $time_day = '';
    $reference_url = '';
    $keywords = '';
    $headline = '';
    //$connecting_words = '';
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
      <p>Enter the name of the company that the content is for.</p>
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
  <input class="order-form-inputs not_required" name="day_month_year" value="<?php echo $day_month_year; ?>" placeholder="(If there is an actual event taking place)" type="text">
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
  <input class="order-form-inputs not_required" name="physical_address" value="<?php echo $physical_address; ?>" placeholder="(If there is an actual event taking place)" type="text">
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
  <input class="order-form-inputs not_required" name="time_day" value="<?php echo $time_day; ?>" placeholder="(If there is an actual event taking place)" type="text">
</div>
</div>
<div class="order-form-full" id="cloneRefUrlDiv-<?php echo $q; ?>">
<div class="order-form-left">
  <h5 class="order-form-label">Reference URLs</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Enter URLs the writer can reference for information.</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs not_required" name="reference_url-1" value="<?php echo $reference_url; ?>" type="text">
  <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneRefUrlDiv-<?php echo $q; ?>','cloneRefUrlDivAdd-<?php echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
</div>
</div>
<div id="cloneRefUrlDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_reference_url-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneRefUrlDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
            <h5 class="order-form-label">Reference URLs</h5>
            <div class="tooltip">
              <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
              <div class="tooltip-text">
                <p>Enter URLs the writer can reference for information.</p>
              </div>
            </div>
          </div>
        <div class="order-form-right">
          <input class="order-form-inputs" name="reference_url-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneRefUrlDivAdd-<?php echo $q; ?>','rowCount-cloneRefUrlDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
</div>
<div class="order-form-full" id="cloneKeyPreReDiv-<?php echo $q; ?>">
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
  <input class="order-form-inputs not_required" name="keywords" value="<?php echo $keywords; ?>" type="text" placeholder="Separates multiple keywords with commas">
  <!-- <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeyPreReDiv-<?php //echo $q; ?>','cloneKeyPreReDivAdd-<?php //echo $q; ?>',3)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a> -->
</div>
</div>
<div class="order-form-full">
<div class="order-form-left">
  <h5 class="order-form-label">Headline</h5>
  <div class="tooltip">
    <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
    <div class="tooltip-text">
      <p>Insert the headline of your news event.</p>
    </div>
  </div>
</div>
<div class="order-form-right">
  <input class="order-form-inputs not_required" name="headline" value="<?php echo $headline; ?>" type="text" placeholder="">
</div>
</div>
<?php /*?><div id="cloneKeyPreReDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_keywords-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeyPreReDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
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
          <input class="order-form-inputs" name="keywords-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeyPreReDivAdd-<?php echo $q; ?>','rowCount-cloneKeyPreReDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
</div><?php */ ?>
<!-- <div class="order-form-full">
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
</div> -->
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
  <textarea class="order-form-inputs not_required" name="news" rows="8" cols="80" placeholder="(Give us detailed information about what's being announced. Answer who, what, when, where and why. Include any details, statistics, dates or other relevant information)"><?php echo $news; ?></textarea>
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
  <textarea class="order-form-inputs not_required" name="relevant_quotes" rows="8" cols="80" placeholder="(Include quotes from peaple/executives close to the sitiation. Please include person's name and title/occupation)"><?php echo $relevant_quotes; ?></textarea>
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
  <textarea class="order-form-inputs not_required" name="boilerplate" rows="8" cols="80" placeholder="(This is the 'About Us' section of the release)"><?php echo $boilerplate; ?></textarea>
</div>
</div>