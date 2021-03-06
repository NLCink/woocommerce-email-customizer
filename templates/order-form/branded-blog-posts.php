<?php 
  $get_order_id = get_post_meta( $orderId, "_comp_order_id_{$productID}-{$q}", true );
  if(!empty($get_order_id)){
    $get_company_name = get_post_meta( $orderId, "_comp_company_name_{$productID}-{$q}", true );
    $get_company_url = get_post_meta( $orderId, "_comp_company_url_{$productID}-{$q}", true );
    $get_blog_topic = get_post_meta( $orderId, "_comp_blog_topic_{$productID}-{$q}", true );
    $get_blog_url = get_post_meta( $orderId, "_comp_blog_url-1_{$productID}-{$q}", true );
    $get_reference_url = get_post_meta( $orderId, "_comp_reference_url_{$productID}-{$q}", true );
    $get_keywords = get_post_meta( $orderId, "_comp_keywords_{$productID}-{$q}", true );
    //$get_conneting_words = get_post_meta( $orderId, "_comp_conneting_words_{$productID}-{$q}", true );
    $get_special_instructions = get_post_meta( $orderId, "_comp_special_instructions_{$productID}-{$q}", true );    
  } else {
    $get_company_name = '';
    $get_company_url = '';
    $get_blog_topic = '';
    $get_blog_url = '';
    $get_reference_url = '';
    $get_keywords = '';
    //$get_conneting_words = '';
    $get_special_instructions = '';
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
    <input class="order-form-inputs" name="company_name" value="<?php echo $get_company_name; ?>" type="text">
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
    <input class="order-form-inputs not_required" name="company_url" value="<?php echo $get_company_url; ?>" type="text">
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
    <input class="order-form-inputs" name="blog_topic" value="<?php echo $get_blog_topic; ?>" type="text">
  </div>
</div>
<div class="order-form-full" id="cloneBlogUrlDiv-<?php echo $q; ?>">
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
    <input class="order-form-inputs not_required" name="blog_url-1" value="<?php echo $get_blog_url; ?>" type="text">
    <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneBlogUrlDiv-<?php echo $q; ?>','cloneBlogUrlDivAdd-<?php echo $q; ?>',5)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a>
  </div>
</div>
<div id="cloneBlogUrlDivAdd-<?php echo $q; ?>">
  <?php 
    $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_blog_url-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneBlogUrlDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Examples Blog URLs</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p>Example:<br> http://example.com</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs not_required" name="blog_url-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneBlogUrlDivAdd-<?php echo $q; ?>','rowCount-cloneBlogUrlDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
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
        <p>Enter URLs the writer can reference for information.</p>
      </div>
    </div>
  </div>
  <div class="order-form-right">
    <input class="order-form-inputs not_required" name="reference_url" value="<?php echo $get_reference_url; ?>" type="text">
  </div>
</div>
<div class="order-form-full" id="cloneKeywordDiv-<?php echo $q; ?>">
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
    <input class="order-form-inputs not_required" name="keywords" value="<?php echo $get_keywords; ?>" type="text" placeholder="Separates multiple keywords with commas">
    <!-- <a href="javascript:void(0)" class="btn-add-more" onclick="addNewItem('cloneKeywordDiv-<?php //echo $q; ?>','cloneKeywordDivAdd-<?php //echo $q; ?>',3)"><img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/plus-icon.png" alt="plus-icon" style="padding: 12px;"></a> -->
  </div>
</div>
<?php /*?>
<div id="cloneKeywordDivAdd-<?php echo $q; ?>">
    <?php 
      $get_post_data = $wpdb->get_results("SELECT * FROM gpm_postmeta as pm WHERE pm.post_id=$orderId AND pm.meta_key LIKE '_comp_keywords-%".$productID."-".$q."' ORDER BY pm.meta_id ASC");
    $r=1;
    foreach ($get_post_data as $key => $value) { 
      if($r > 1 ){
      ?>
      <div class="order-form-full" id="rowCount-cloneKeywordDiv-<?php echo $q; ?>-<?php echo $r; ?>" data-number="0">
        <div class="order-form-left" style="visibility: hidden;">
          <h5 class="order-form-label">Keywords (up to 3)</h5>
          <div class="tooltip">
            <img src="http://plugin.bkacontent.com/wp-content/uploads/2017/01/tooltip-img.png" alt="tooltip-img">
            <div class="tooltip-text">
              <p>Example:<br>"plumbing SLC"</p>
            </div>
          </div>
        </div>
        <div class="order-form-right">
          <input class="order-form-inputs required" name="keywords-<?php echo $r; ?>" value="<?php echo $value->meta_value; ?>" type="text" aria-required="true">
          <a href="javascript:void(0)" class="btn-add-more btn-danger" onclick="removeItem('cloneKeywordDivAdd-<?php echo $q; ?>','rowCount-cloneKeywordDiv-<?php echo $q; ?>-<?php echo $r; ?>')"><i style="font-size:47px;margin-top:-3px;" class="fa fa-minus-square" aria-hidden="true"></i></a>
        </div>
      </div>
    <?php } $r++; } ?>
</div><?php */ ?>
<!-- <div class="order-form-full">
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
    <input class="order-form-inputs required" name="conneting_words" value="<?php //echo $get_conneting_words; ?>" type="text">
  </div>
</div> -->
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
    <textarea class="order-form-inputs not_required" name="special_instructions" rows="8" cols="80" placeholder="Insert the general guidelines for this content, if any"><?php echo $get_special_instructions; ?></textarea>
  </div>
</div>