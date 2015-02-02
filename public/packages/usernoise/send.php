<?php
if (!function_exists('json_encode')){
  echo '{"errors": ["Your installation does not have json_encode function. Please upgrade your PHP"]}';
  exit(0);
}

require(dirname(__FILE__) . "/common.php");
require(ABSPATH . "/vendor/phpmailer/class.phpmailer.php");
global $locale, $h, $config;
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : null;
if (!$type){
	$type = "feedback";
}
$errors = array();
$message = sprintf("A new %s has been submitted.\r\n\r\n", $type);
$email = null;
if (isset($_REQUEST['email']) && trim($_REQUEST['email'])){
	$email = strip_slashes_if_needed($_REQUEST['email']);
}
$title = null;
if (isset($_REQUEST['title']) && trim($_REQUEST['title'])){
	$title = strip_slashes_if_needed($_REQUEST['title']);
}
if ($config['feedback.email.show']){
	if (!$email || $email == $locale['form.email.placeholder'])
		$errors []= $locale['form.email.missing'];
	else if (!is_email($email))
		$errors []= $locale['form.email.invalid'];
}
if ($config['feedback.summary.show'] && (!$title || $title == $locale['form.summary.placeholder'])){
	$errors []= $locale['form.summary.missing'];
}
$feedback = null;
if (isset($_REQUEST['description']) && trim($_REQUEST['description'])){
	$feedback = trim(strip_slashes_if_needed($_REQUEST['description']));
}
if (!$feedback || $feedback == $locale['form.description.placeholder']){
	$errors []= $locale['form.description.missing'];
}
if (count($errors)){
	echo json_encode(array('errors' => $errors));
	exit;
}
if ($email){
	$message .= "Email: " . $email . "\r\n";
}
if ($title){
	$message .= "Title: " . $title . "\r\n";
}
$message .= "Sent from: " . trim(strip_slashes_if_needed($_REQUEST['referer'])) . "\r\n";
$message .= "Message: \r\n" . $feedback . "\r\n";

$subject = sprintf('New %s submitted', $type);

$mail = new PHPMailer();
if ($config['email.smtp.enable']){
	$mail->IsSMTP();
	$mail->Host = $config['email.smtp.host'];
	$mail->Port = $config['email.smtp.port'];
	if ($config['email.smtp.auth']){
		$mail->SMTPAuth = $config['email.smtp.auth'];
		$mail->Username = $config['email.smtp.login'];
		$mail->Password = $config['email.smtp.password'];
	}
	if ($config['email.smtp.secure'])
		$mail->SMTPSecure = $config['email.smtp.secure'];
}

$mail->From       = $config['email.from'];
$mail->FromName   = $config['email.from.name'];
$mail->Subject    = $config['email.subject'];
$mail->WordWrap   = 50; // set word wrap
$mail->CharSet = 'UTF-8';
$mail->Body = $message;
if ($email)
	$mail->AddReplyTo($email);
$mail->AddAddress($config['email.to']);

if(!$mail->Send()) {
		echo json_encode(array('errors' => array($mail->ErrorInfo)));
} else {
	  echo json_encode(array('success' => true));
}
