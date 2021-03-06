<?php
if ( ! current_user_can( 'manage_woocommerce' ) )
	wp_die( __( 'Cheatin&#8217; uh?', 'email-control' ) );

global $wp_scripts, $woocommerce, $wpdb, $current_user, $order, $cxec_email_control;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="<?php echo 'Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'); ?>" />
	<title>
		Prevew Email Template
	</title>

	<?php
	do_action( 'ec_render_template_head_scripts' );
	
	print_head_scripts(); //This is the main one
	print_admin_styles();
	?>
</head>
<body id="ec-template" class="ec-template" >
	
	<?php
	$mails = $woocommerce->mailer()->get_emails();
	
	// Ensure gateways are loaded in case they need to insert data into the emails
	$woocommerce->payment_gateways();
	$woocommerce->shipping();
	
	/* Get Email to Show */
	if ( isset($_REQUEST['ec_email_type']) )
		$email_type = $_REQUEST['ec_email_type'];
	else
		$email_type = current($mails)->id;
	
	/* Get Email Template to Show */
	if ( isset($_REQUEST['ec_email_template']) )
		$email_template = $_REQUEST['ec_email_template'];
	else
		$email_template = false;

	/* Get Order to Show */
	if ( isset($_REQUEST['ec_email_order']) ) {
		$order_id_to_show = $_REQUEST['ec_email_order'];
	}
	else{
		//Get the most recent order.
		$order_collection = new WP_Query(array(
			'post_type'			=> 'shop_order',
			'post_status'		=> array_keys( wc_get_order_statuses() ),
			'posts_per_page'	=> 1,
		));
		$order_collection = $order_collection->posts;
		$latest_order = current($order_collection)->ID;
		$order_id_to_show = $latest_order;
	}
	
	/**
	 * Prep the order, and display an error message if there isn't one yet.
	 */
	
	$order = new WC_Order( $order_id_to_show );
	// $order = new WC_Order( 'test' );
	
	if ( ! $order->post ) :
		?>
		<div class="email-template-preview pe-in-admin-page">
			<div class="main-content">
				
				<!-- ---------- No Order Warning ---------- -->
				
				<div class="compatability-warning-text">
					<span class="dashicons dashicons-welcome-comments"></span>
					<!-- <h6><?php _e( "You'll need at least one order to use Email Customizer properly", 'email-control' ) ?></h6> -->
					<h6><?php _e( "You'll need at least one order to preview all the email types correctly", 'email-control' ) ?></h6>
					<p>
						<?php _e( "Simply follow your store's checkout process to create at least one order, then return here to preview all the possible email types.", 'email-control' ) ?>
					</p>
				</div>
				
				<!-- ---------- / No Order Warning ---------- -->
			
				<?php
				
				/**
				 * Copied from class-wc-admin.php
				 */
				
				// load the mailer class
				$mailer = WC()->mailer();

				// get the preview email subject
				$email_heading = __( 'HTML Email Template', 'woocommerce' );

				// get the preview email content
				ob_start();
				include( WC()->plugin_path() . '/includes/admin/views/html-email-template-preview.php' );
				$message = ob_get_clean();
				
				// create a new email
				$email = new WC_Email();
				
				// wrap the content with the email template and then add styles
				$message = $email->style_inline( $mailer->wrap_message( $email_heading, $message ) );

				// print the preview email
				echo $message;
				?>
			
			</div>
		</div>
		<?php
		
	else :
		
		if ( ! empty( $mails ) ) {
			foreach ( $mails as $mail ) {
				if ( $mail->id == $email_type ) {
					
					// Important Step: populates the $mail object with the necessary properties for it to Preview (or Send a test).
					// It also returns a BOOLEAN for whether we have checked this email types preview with our plugin.
					$compat_warning = $cxec_email_control->populate_mail_object( $order, $mail );
					
					// Info Meta Swicth on/off
					$header = ( get_user_meta( $current_user->ID, 'header_info_userspecifc', true) ) ? get_user_meta( $current_user->ID, 'header_info_userspecifc', true ) : 'off' ;
					?>
					
					<div class="email-template-preview pe-in-admin-page">
						<div class="main-content">
						
							<?php if ( ! ec_check_template_version( $email_template ) ) : ?>
								
								<!-- ---------- WooCommerce Version Warning ---------- -->
								
								<div class="compatability-warning">
									<div class="compatability-warning-text">
										<span class="dashicons dashicons-welcome-comments"></span>
										<h6><?php _e( "You need to update WooCommerce in order to use this template", 'email-control' ) ?></h6>
										<p>
											<?php _e( "The template you selected requires the latest version of WooCommerce - please first update, then return here and select it.", 'email-control' ) ?>
										</p>
									</div>
								</div>
								
								<!-- ---------- / WooCommerce Version Warning ---------- -->
								
							<?php elseif ( $compat_warning && ( $mail->id !== $_REQUEST['ec_approve_preview'] ) ) : ?>
								
								<!-- ---------- Compatability Warning ---------- -->
								
								<div class="compatability-warning">
									<div class="compatability-warning-text">
										<span class="dashicons dashicons-welcome-comments"></span>
										<h6><?php _e( "We've not seen this email type from this third party plugin before", 'email-control' ) ?></h6>
										<p>
											<?php _e( "Don't worry, the email will send fine, you just can't preview it. Customizing it - here are your options. Option 1: choose to show one of the other known emails and customize it (colors, sizes, etc) - the styling will be inherited if they have included the header and footer in the normal way. Option 2: choose to dismiss this message and see if it just works. If you see a blank screen then use option 1.", 'email-control' ) ?>
											<a href="#" id="ec_approve_preview_button" data-approve-preview="<?php echo $mail->id ?>" ><?php _e( 'Dismiss', 'email-control' ); ?></a>
										</p>
									</div>
								</div>
								
								<!-- ---------- / Compatability Warning ---------- -->
								
							<?php else: ?>
								
								<!-- ---------- Header Info ---------- -->
								
								<div class="header-info" style="<?php if ( 'on' == $header ) echo 'display: block;'; ?>">
									
									<div class="header-info-label-block">
										<div class="header-info-meta-heading">
											<?php _e( "Header Info", 'email-control' ) ; ?> <span class="help-icon" title="<?php _e( 'The header infomration that will be sent with the current Template. This can be changed in WooCommerce Settings > Emails, or simply click Edit next to the relevant field to be taken there.', 'email-control' ); ?>" >&nbsp;&nbsp;&nbsp;&nbsp;</span>
										</div>
									</div>
									
									<div class="header-info-meta-blocks">
										
										<div class="header-info-meta-block header-info-meta-block-subject">
											<div class="header-info-meta-heading">
												<?php _e( "Subject", "email-control" ) ; ?>
											</div>
											<div class="header-info-meta">
												<span class="meta-value"><?php echo $mail->get_subject() ?></span> 
												<span class="meta-divider">|</span> 
												<a class="edit-meta" target="wc-settings" href="<?php echo admin_url( 'admin.php?page=wc-settings&tab=email&section=' . "wc_email_{$mail->id}" ); ?>"><?php _e( "Edit", 'email-control' ) ; ?></a>
											</div>
										</div>
										
										<div class="header-info-meta-block header-info-meta-block-from-email">
											<div class="header-info-meta-heading">
												<?php _e( "From Email", 'email-control' ) ; ?>
											</div>
											<div class="header-info-meta">
												<span class="meta-value"><?php echo $mail->get_from_address() ?></span> 
												<span class="meta-divider">|</span> 
												<a class="edit-meta" target="wc-settings" href="<?php echo admin_url('admin.php?page=wc-settings&tab=email') ?>"><?php _e( "Edit", 'email-control' ) ; ?></a>
											</div>
										</div>
										
										<div class="header-info-meta-block header-info-meta-block-frome-name">
											<div class="header-info-meta-heading">
												<?php _e( "From Name", 'email-control' ) ; ?>
											</div>
											<div class="header-info-meta">
												<span class="meta-value"><?php echo $mail->get_from_name() ?></span> 
												<span class="meta-divider">|</span> 
												<a class="edit-meta" target="wc-settings" href="<?php echo admin_url('admin.php?page=wc-settings&tab=email') ?>"><?php _e( "Edit", 'email-control' ) ; ?></a>
											</div>
										</div>
										
										<div class="header-info-meta-block header-info-meta-block-to-email">
											<div class="header-info-meta-heading">
												<?php _e( "To Email", 'email-control' ) ; ?>
											</div>
											<div class="header-info-meta">
												<span class="meta-value"><?php echo $order->billing_email ?></span>
											</div>
										</div>
									
									</div>
									
									<a class="hide-icon hide-up" <?php if ( $header ) { ?> style="display:block" <?php } ?> ></a>
											
								</div>
								
								<a class="hide-icon hide-down" <?php if ( $header ) { ?> style="display:none" <?php } ?> ></a>
								
								<!-- ---------- / Header Info ---------- -->
								
								
								<!-- ----------  Email Template ---------- -->
								
								<?php
								// Get the email contents. using @ to block ugly error messages showing in the preview.
								// The following mimics what WooCommerce does in it's `->send` method of WC_Email.
								@ $email_message = $mail->get_content();
								$email_message   = $mail->style_inline( $email_message );
								$email_message   = apply_filters( 'woocommerce_mail_content', $email_message );
								
								// Convert line breaks to <br>'s if the mail is type 'plain'.
								if ( 'plain' === $mail->email_type )
									$email_message = '<div style="padding: 35px 40px; background-color: white;">' . str_replace( "\n", '<br/>', $email_message ) . '</div>';
								
								// Display the email.
								echo $email_message;
								?>
								
								<!-- ----------  / Email Template ---------- -->
								
							<?php endif; ?>
							
						</div>
					</div>
					
					<?php
				}
			}
		}
	
	endif;
	?>
	
</body>
</html>

<?php exit; ?>
