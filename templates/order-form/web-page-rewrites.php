<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}-{$q}", true );
    $current_website = get_post_meta( $orderId, "_comp_current_website_{$productID}-{$q}", true );
    $url_needing_rewritten = get_post_meta( $orderId, "_comp_url_needing_rewritten_{$productID}-{$q}", true );
    $page_name = get_post_meta( $orderId, "_comp_page_name-1_{$productID}-{$q}", true );
    $keywords = get_post_meta( $orderId, "_comp_keywords-1_{$productID}-{$q}", true );
    $connecting_words = get_post_meta( $orderId, "_comp_connecting_words_{$productID}-{$q}", true );
    $special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );
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
<div class="order-form-full" id="clonePageWpreDiv-<?php echo $q; ?>">
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
    <input class="order-form-inputs" name="page_name-1" value="<?php echo $page_name; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('clonePageWpreDiv-<?php echo $q; ?>','clonePageWpreDivAdd-<?php echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="clonePageWpreDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_page_name-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-clonePageWpreDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
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
          <input class="order-form-inputs" name="page_name-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('clonePageWpreDivAdd-<?php echo $q; ?>','rowCount-clonePageWpreDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
   <?php } $r++; } ?>
</div>
<div class="order-form-full" id="cloneKeywordWpreDiv-<?php echo $q; ?>">
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
    <input class="order-form-inputs" name="keywords-1" value="<?php echo $keywords; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeywordWpreDiv-<?php echo $q; ?>','cloneKeywordWpreDivAdd-<?php echo $q; ?>',3)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="cloneKeywordWpreDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_keywords-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeywordWpreDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
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
          <input class="order-form-inputs" name="keywords-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeywordWpreDivAdd-<?php echo $q; ?>','rowCount-cloneKeywordWpreDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
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