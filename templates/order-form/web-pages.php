<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}-{$q}", true );
    $current_website = get_post_meta( $orderId, "_comp_current_website_{$productID}-{$q}", true );
    $page_name = get_post_meta( $orderId, "_comp_page_name_{$productID}-{$q}", true );
    $example_websites = get_post_meta( $orderId, "_comp_example_websites-1_{$productID}-{$q}", true );
    $reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}-{$q}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords-1_{$productID}-{$q}", true );
    $connecting_words = get_post_meta( $orderId, "_comp_conneting_words_{$productID}-{$q}", true );
    $headlines = get_post_meta( $orderId, "_comp_headlines_{$productID}-{$q}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );    
  } else {
    $company_name = '';
    $current_website = '';
    $page_name = '';
    $example_websites = '';
    $reference_url = '';
    $keywords = '';
    $connecting_words = '';
    $headlines='';
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
    <h5 class="order-form-label">Page Name</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
Heating<br>
&gt;Furnaces<br>
&gt;&gt;Furnace Repair<br>
Cooling<br>
&gt;Air Conditioners<br>
&gt;&gt;Air Conditioner Repair</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="page_name" value="<?php echo $page_name; ?>" type="text">
  </div>
</div>
<div class="order-form-full" id="cloneExmWePDiv-<?php echo $q; ?>">
  <div class="order-form-left">
    <h5 class="order-form-label">Example Websites(s)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Please give us the URLs of websites that we can pull information from (or emulate). These could also be competitors' websites that have content that you like.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="example_websites-1" value="<?php echo $example_websites; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneExmWePDiv-<?php echo $q; ?>','cloneExmWePDivAdd-<?php echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="cloneExmWePDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_example_websites-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneExmWePDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Example Websites(s)</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p>Please give us the URLs of websites that we can pull information from (or emulate). These could also be competitors' websites that have content that you like.</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs" name="example_websites-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneExmWePDivAdd-<?php echo $q; ?>','rowCount-cloneExmWePDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
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
<div class="order-form-full" id="cloneKeyWordWpDiv-<?php echo $q; ?>">
  <div class="order-form-left">
    <h5 class="order-form-label">Keywords (up to 5)</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          air conditioners, AC repair in Utah</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="keywords-1" value="<?php echo $Keywords; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeyWordWpDiv-<?php echo $q; ?>','cloneKeyWordWpDivAdd-<?php echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="cloneKeyWordWpDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_keywords-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeyWordWpDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Keywords (up to 5)</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p><strong>Example:</strong><br>
                air conditioners, AC repair in Utah</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs" name="keywords-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeyWordWpDivAdd-<?php echo $q; ?>','rowCount-cloneKeyWordWpDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Connecting Words</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p>Connecting words are words such as “in”, “for”, or “around”.  These words help make keywords easier to read or grammatically correct.   For example, if your keyword was “plumbing SLC”, then including connecting words would allow a writer to insert the keyword in the article as “plumbing in SLC”.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="connecting_words" value="<?php echo $connecting_words; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">H1 or H2 Headlines</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
H1:  Professional Air Conditioning Services<br>
H2:  Service for all Types of Air Conditioner Units<br>
H2:  Reasons to Invest in Professional Service for Your AC<br>
(Separate each heading by pressing CTRL-Enter.)</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs" name="headlines" value="<?php echo $headlines; ?>" type="text">
  </div>
</div>
<div class="order-form-full">
  <div class="order-form-left">
    <h5 class="order-form-label">Special Instructions</h5>
    <div class="tooltip">
      <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
      <div class="tooltip-text">
        <p><strong>Example:</strong><br>
          Match the tone of the existing pages on the site.  Include the keywords 3 times each per page. The geo target is SLC, UT, so please use that where relevant. Company has A+ rating from the BBB and 24-hour emergency services. Include our phone # in call to action on each page. 777-777-7777<br>
          <strong>Example:</strong><br>
          Make sure to include a bulleted list of the AC Units that we carry somewhere on the page.
        </p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <textarea class="order-form-inputs" name="special_instructions" rows="8" cols="80" placeholder="Insert general guidelines for this branded blog post"><?php echo $special_instructions; ?></textarea>
  </div>
</div>