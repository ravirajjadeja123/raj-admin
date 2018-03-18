<?php

/*Gmail*/

define('SMTP_USERNAME','ncttrainingcenter@gmail.com');
define('SMTP_PASSWORD','ncrypted123');

define('SMTP_HOST','smtp.gmail.com');
define('SMTP_PORT','465');
define('FROM_NM','Foram');
define('FROM_EMAIL','sforam007@gmail.com');



require_once("class.phpmailer.php");


function sendMail($to,$subject,$message) {
	
	$from_nm=FROM_NM;
	$from_email=FROM_EMAIL;	
	
	$subject = $subject;
	$mailbody = $message;


	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	//mail via gmail

	$mail->SMTPSecure = 'ssl'; //https = ssl site
	$mail->Host = SMTP_HOST;
	$mail->Port = SMTP_PORT;


	$mail->IsHTML(true);
	$mail->Username = SMTP_USERNAME;
	$mail->Password = SMTP_PASSWORD;
	$mail->SetFrom($from_email);
	$mail->AddReplyTo($from_email, $from_nm);
	$mail->Subject = $subject;
	$mail->Body = $mailbody;
	$mail->AddAddress($to);
	
	$result = true;
	if(!$mail->Send()){
		$result = false;
	}
	//echo "Mailer Error: " . $mail->ErrorInfo;
	return $result;
}


	$email="ncttrainingcenter@gmail.com";
	$subject ="test mail";
	$messages = "test message<b>Bold</b> <a href='#'>click here</a>";
	$check_mail = sendMail($email,$subject,$messages);

	/*if($check_mail)
	{
		echo 'if';
	}
	else
	{
		echo 'else';
	}*/


?>	