<?php 
$emailSubject = "test subject"; 
$sendTo = "skambham@innominds.com"; 
$emailFrom = "sampleproject888@gmail.com";  //put whatever email address that you want

$body = "hjbsshshuvjBdvbulzs" ;

$headers = "From: $emailFrom";

$success = mail($sendTo, $emailSubject, $body, $headers); 
echo $success;

?>