<?php 
require 'mail_setting.php';
//require 'dbCon.php';
global $wpdb;

$get_post_data = $wpdb->get_results("SELECT ps.ID as postId,pm.meta_value as email_address FROM gpm_posts as ps 
    JOIN gpm_postmeta as pm ON (pm.post_id = ps.ID AND pm.meta_key='_billing_email')
    WHERE ps.post_status='wc-on-hold' AND ps.post_type='shop_order' AND ps.post_date BETWEEN curdate() - interval 60 day and curdate() - interval 3 day");
    $allEmails = [];
    $home_url = home_url('/');
    foreach ($get_post_data as $key => $get_post_val) {
      $reminder_email_send = get_post_meta( $get_post_val->postId, "is_send_reminder", true );
      if($reminder_email_send !='yes'){
        $postid = $get_post_val->postId;
        $formPageUrl = $home_url.'order-completion-form/?order_id='.$postid;
        $email_body = '<table class="wrapper" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666; font-size: 14px; background-color: #e8e8e8; width: 100%; -webkit-text-size-adjust: none !important; margin: 0; padding: 50px 0 50px 0;">
            <tbody><tr style="font-family: Arial, sans-serif; line-height: 2em;">
                <td class="wrapper-td" align="center" valign="top" style="font-family: Arial, sans-serif; line-height: 2em; padding: 0 20px 20px;">
                  <table class="main-body" border="0" cellpadding="0" cellspacing="0" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666; box-shadow: 0 3px 9px rgba(0, 0, 0, 0.03); border-radius: 5px !important; overflow: hidden; background-color: #ffffff; border: 1px solid #d1d1d1; width: 800px;">
                    <tbody>
                        <tr style="font-family: Arial, sans-serif; line-height: 2em;">
                          <td align="center" valign="top" style="font-family: Arial, sans-serif; line-height: 2em;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666;">
                              <tbody>
                                <tr style="font-family: Arial, sans-serif; line-height: 2em;">
                                  <td class="template_header" style="font-family: Arial; line-height: 2em; background-color: #3d3d3d; color: #e2e2e2; border-top-left-radius: 2px !important; border-top-right-radius: 2px !important; border-bottom: 1px solid #3a3a3a; font-weight: bold; vertical-align: middle; text-align: center; padding: 16.666666666667px 23.076923076923px;">
                                    <a href="'.$home_url.'" border="0" style="color: #e2e2e2 !important; font-style: none; text-decoration: none; font-weight: normal; font-size: 13px; margin: 0 0 0 12px;">
                                      <img src="http://www.bkacontent.com/wp-content/uploads/2015/10/BKAnewlogowhiteLarge-e1444804499164.png">
                                    </a>                     
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>                
                        <tr style="font-family: Arial, sans-serif; line-height: 2em;">
                          <td align="left" valign="top" style="font-family: Arial, sans-serif; line-height: 2em;">                
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666;">
                          <tbody>
                          <tr style="font-family: Arial, sans-serif; line-height: 2em;">
                            <td valign="top" class="body_content" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666; background-color: #ffffff;">
                                <table border="0" cellspacing="0" width="100%" style="font-family: Arial, sans-serif; line-height: 2em; color: #666666;">
                                  <tbody>
                                    <tr style="font-family: Arial, sans-serif; line-height: 2em;">
                                      <td valign="top" class="body_content_inner" style="font-family: Arial; line-height: 2em; text-align: left; padding-left: 55px; padding-right: 55px; padding-top: 30px; padding-bottom: 30px;">
                                          <p style="margin: .6em 0;">It has been three days since you ordered from BKA Content.</p>
                                          <p style="margin: .6em 0;">Please click on the link below to complete your order...<br/>
                                          <a href="'.$formPageUrl.'" alt="Complete order form" title="Complete order form">'.$formPageUrl.'</a></p>
                                          <p style="margin: .6em 0;">On this page you will have a form(s) to fill out in order for us to start the writing process.</p>
                                          <p style="margin: .6em 0;">If you have any questions please feel free to contact us at sales@bkacontent.com or reply to this email address.</p>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                              </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                      </tr>
                    </tbody>
                    </table>
                </td>
              </tr>
          </tbody>
        </table>';
    $email_content = $email_body;
    $email_to = str_replace("'", "", $get_post_val->email_address);
    $email_cc = str_replace("'", "", 'jakir44.du@gmail.com');
    $attachment = '';
    $mail->setFrom('no-reply@bkacontent.com', 'BKA Content');
    $mail->addAddress($email_to, '');     // Add a recipient

    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('jakir.ocpl@batworld.com', 'BKA Content');
     $mail->addCC($email_cc);

     //$mail->addBCC('jakir.ocpl@batworld.com');
      //$mail->addAttachment($attachment);         // Add attachments
      //$mail->addAttachment('http://beza.sms.com.bd/uploads/2016/10/beza_57f09bb96aaa79.73874888.pdf', 'beza_57f09bb96aaa79.73874888.pdf');    // Optional name
      $mail->isHTML(true); // Set email format to HTML

      //$attachments = '<br/><a href="'.$attachment.'"><u>Click here for download the security clearance.</u></a>';

      $mail->Subject = 'Ordered from BKA Content';
      $mail->Body    = $email_content;
      $mail->AltBody = '';
      if(!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        
           if ( ! add_post_meta( $postid, "is_send_reminder", 'yes', true ) ) { 
              update_post_meta( $postid, "is_send_reminder", 'yes' );
            }
    
         echo 'Message has been sent on';
      }
      $mail->ClearAddresses();
      $mail->ClearCCs();
     }  
  }
?>