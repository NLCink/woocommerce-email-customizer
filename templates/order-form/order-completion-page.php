<?php
get_header();
$order = wc_get_order( 24991 );
/*
?>

<header><h2><?php _e( 'Customer Details', 'woocommerce' ); ?></h2></header>

<table class="shop_table customer_details">
  <?php if ( $order->customer_note ) : ?>
    <tr>
      <th><?php _e( 'Note:', 'woocommerce' ); ?></th>
      <td><?php echo wptexturize( $order->customer_note ); ?></td>
    </tr>
  <?php endif; ?>

  <?php if ( $order->billing_email ) : ?>
    <tr>
      <th><?php _e( 'Email:', 'woocommerce' ); ?></th>
      <td><?php echo esc_html( $order->billing_email ); ?></td>
    </tr>
  <?php endif; ?>

  <?php if ( $order->billing_phone ) : ?>
    <tr>
      <th><?php _e( 'Telephone:', 'woocommerce' ); ?></th>
      <td><?php echo esc_html( $order->billing_phone ); ?></td>
    </tr>
  <?php endif; ?>

  <?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

<div class="col2-set addresses">
  <div class="col-1">

<?php endif; ?>

<header class="title">
  <h3><?php _e( 'Billing Address', 'woocommerce' ); ?></h3>
</header>
<address>
  <?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
</address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

  </div><!-- /.col-1 -->
  <div class="col-2">
    <header class="title">
      <h3><?php _e( 'Shipping Address', 'woocommerce' ); ?></h3>
    </header>
    <address>
      <?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
    </address>
  </div><!-- /.col-2 -->
</div><!-- /.col2-set -->

<?php endif; */ ?>

<?php //do_action( 'woocommerce_thankyou', 24991 ); ?>
<div id="main-content">

<div class="wraper clearfix">
      <div class="container">
        <section class="order-section area">

        


          <h4 class="order-no"><span>Order # 3322</span> - Branded Blog Post - 450 words &amp; Branded Blog post -1000 words</h4>
          <h2 class="progress-title">Your Progress <span class="progress-lenght">45%</span></h2>
          <div class="progress-container">
            <div class="progressbar" style="width:45%"></div>
          </div>
          <h3 class="order-form-titie">Please complete the forms(s) bellow to complete your order</h3>


            <?php
            $inc=1;

            foreach( $order->get_items() as $item_id => $item ) {

            
              //echo $order->display_item_meta( $item );
            //echo $order->get_formatted_line_subtotal( $item );

            //print_r($item['item_meta_array']);

            $formatted_meta = array();
            $hideprefix = '_';
            if ( ! empty( $item['item_meta_array'] ) ) {
              foreach ( $item['item_meta_array'] as $meta_id => $meta ) {
                if ( "" === $meta->value || is_serialized( $meta->value ) || ( ! empty( $hideprefix ) && substr( $meta->key, 0, 1 ) === $hideprefix ) ) {
                  continue;
                }

                $attribute_key = urldecode( str_replace( 'attribute_', '', $meta->key ) );
                $meta_value    = $meta->value;

                // If this is a term slug, get the term's nice name
                if ( taxonomy_exists( $attribute_key ) ) {
                  $term = get_term_by( 'slug', $meta_value, $attribute_key );

                  if ( ! is_wp_error( $term ) && is_object( $term ) && $term->name ) {
                    $meta_value = $term->name;
                  }
                }

                if ( ! empty( $item['variation_id'] ) && 'product_variation' === get_post_type( $item['variation_id'] ) ) {
                $_product = wc_get_product( $item['variation_id'] );
                $productID = $item['variation_id'];
              } elseif ( ! empty( $item['product_id']  ) ) {
                $productID = $item['product_id'];
                $_product = wc_get_product( $item['product_id'] );
              } else {
                $productID = 0;
                $_product = false;
              }

                $formatted_meta[ $meta_id ] = array(
                  'key'   => $meta->key,
                  'label' => wc_attribute_label( $attribute_key, $_product ),
                  'value' => apply_filters( 'woocommerce_order_item_display_meta_value', $meta_value ),
                );

              }
            }
            $delimiter = ", \n";
            if ( ! empty( $formatted_meta ) ) {
              $meta_list = array();

              foreach ( $formatted_meta as $meta ) {
                  $meta_list[] = wp_kses_post( $meta['value'] );
              }

              if ( ! empty( $meta_list ) ) {
                $output_attribute = $meta_list[0];//implode( $delimiter, $meta_list );
              }
            } ?>

          <div class="divider"></div>
          <h3 class="form-name">Form <?php echo $inc; ?></h3>
          <div class="word-wrap">
            <h3 class="word-count">Product: <?php echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item['name'] ) : $item['name'], $item, $is_visible );
              echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );
              echo ' - ';
              echo $output_attribute; ?></h3>
            <a href="#" class="btn-order-clear">Demo</a>
          </div>
          <div class="form-wrap area">
            <form class="order-form area" action="#" method="post" onsubmit="return saveOrderCompletion(this);">
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
                  <input class="order-form-inputs" name="companyName" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <textarea class="order-form-inputs" name="name" rows="8" cols="80" placeholder="( Insert general guidelines for this branded blog post )"></textarea>
                </div>
              </div>
              <div class="word-wrap">
                <input type="submit" name="orderCompletionSave" class="btn-order-fill" value="Save" />
                <input type="submit" name="orderCompletionSave" class="btn-order-clear" value="Complete" />
              </div>
            </form>
          </div>
        <?php
            $inc++;
        }
        ?>

          <?php /* ?><h3 class="form-name">Form 2</h3>
          <div class="word-wrap">
            <h3 class="word-count">Product: Branded Blogpost - 1000 words</h3>
            <a href="#" class="btn-order-clear">Demo</a>
          </div>
          <div class="form-wrap area">
            <form class="order-form area" action="#" method="post">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <input class="order-form-inputs" name="" value="" type="text">
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
                  <textarea class="order-form-inputs" name="name" rows="8" cols="80" placeholder="( Insert general guidelines for this branded blog post )"></textarea>
                </div>
              </div>
              <div class="word-wrap">
                <a href="#" class="btn-order-fill">Save</a><a href="#" class="btn-order-clear">Complete</a>
              </div>
            </form>
          </div><?php */ ?>
        </section>



      </div>
    </div>
    <link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>main.css" />
</div> <!-- #main-content -->

<script type="text/javascript">
  function saveOrderCompletion(thisItem){
      var companyName = $(thisItem).("input[name=companyName]").val();
      console.log(companyName);
      return false;
  }
</script>

<?php get_footer(); ?>