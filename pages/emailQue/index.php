<?php
require 'mail_setting.php';
require 'dbCon.php';

/* return name of current default database */
if ($result = $mysqli->query("SELECT id,app_id,secret_key,pdf_type FROM email_queue WHERE status=0")) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $app_id = $row['app_id'];
        $reg_key = $row['secret_key'];
        $pdf_type = $row['pdf_type'];

        $data = array();
        $data['data'] = array(
            'reg_key'=>$reg_key,       // Authentication key
            'pdf_type'=>$pdf_type,         // letter type
            'ref_id'=>$app_id,          //app_id
            'param'=>array(
                'app_id'=>$app_id  // app_id
            )
        );
        $data1 = json_encode($data);
        $url = "https://pdfservice.pilgrimdb.org:8092/api/job-status?requestData=$data1";
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 150);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n<br />";
            $response = '';
        } else {
            curl_close($ch);
        }

        $dataResponse = json_decode($response);
        if (!empty($dataResponse->response) && $dataResponse->response->status == 1){
            $attachmentUrl = $dataResponse->response->download_link;
            $sql = "UPDATE email_queue SET attachment='".$attachmentUrl."' WHERE id=$id";
            $mysqli->query($sql);
        }
        else{
            $sql = "UPDATE email_queue SET attachment='' WHERE id=$id";
            $mysqli->query($sql);
        }
    }
    $result->close();
}
$count=0;
if ($result2 = $mysqli->query("SELECT id,email_to,email_cc,email_content,attachment FROM email_queue WHERE status=0 AND attachment!=''")) {

    while($row = $result2->fetch_assoc()) {
        $email_to = '';
        $id = $row['id'];
        $email_content = $row['email_content'];
        $email_to = str_replace("'", "", $row['email_to']);
        $email_cc = str_replace("'", "", $row['email_cc']);
        $attachment = $row['attachment'];

        $mail->setFrom('no-reply@moha.com.bd', 'Ministry of Home Affairs');

        $mail->addAddress($email_to, '');     // Add a recipient

        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('jakir.ocpl@batworld.com', 'Ministry of Home Affairs');
        $email_cc_exp = explode(',',$email_cc);
        if(!empty($email_cc_exp[1])){
            foreach($email_cc_exp as $emailCC){
                $mail->addCC($emailCC);
            }
        } else {
            $mail->addCC($email_cc);
        }

        //$mail->addBCC('jakir.ocpl@batworld.com');
        $mail->addAttachment($attachment);         // Add attachments
        //$mail->addAttachment('http://beza.sms.com.bd/uploads/2016/10/beza_57f09bb96aaa79.73874888.pdf', 'beza_57f09bb96aaa79.73874888.pdf');    // Optional name
        $mail->isHTML(true); // Set email format to HTML

        $attachments = '<br/><a href="'.$attachment.'"><u>Click here for download the security clearance.</u></a>';

        $mail->Subject = 'Application Update Information';
        $mail->Body    = $email_content.$attachments;
        $mail->AltBody = '';
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $sql = "UPDATE email_queue SET status=1 WHERE id=$id";
            $mysqli->query($sql);
            echo 'Message has been sent on '.date();
        }
        $mail->ClearAddresses();
        $mail->ClearCCs();
		$count++;
    }
    $result2->close();
}
$mysqli->close();
if($count==0){
	echo '<br>No email in queue to send! '.date();		
}
die();