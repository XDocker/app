<?php
$config = array();
// Form options
$config['home'] = ''; // Change this if you put Usernoise in an another folder.
$config['feedback.types.show'] = true; // Show feedback types at the top of the form
$config['feedback.summary.show'] = true; // Show "short summary" field.
$config['feedback.email.show'] = true; // Show "email" field.


// It is recommended to stick to default Gmail configuration.
// Just put your gmail account address and password to the fields below - and it will work in 99%.
// Don't forget to log into Gmail from your browser and confirm an authentication attempt!
$config['email.to'] = 'info@xervmon.com'; //Email address you want notifications to be sent to.
$config['email.smtp.password'] = 'Java9873#man'; // Your email password.

// You want these nitty gritty delivery options? We got them.
$config['email.from'] = ''; // Default to the same email. You can change it if you want.
$config['email.from.name'] = 'xDock Team'; // Human readable FROM name.
$config['email.subject'] = 'New Feedback Received'; // Notification email subject.
$config['email.smtp.enable'] = true; // Use PHP mail() function by default. Please note that SMTP delivery works MUCH better usually.
$config['email.smtp.host'] = 'smtp.gmail.com'; // Default to Gmail.
$config['email.smtp.secure'] = 'ssl'; // Allowed values are null, 'ssl' and 'tls'. SSL is best for Gmail.
$config['email.smtp.port'] = '465'; //SSL SMTP port. 25 for non-secure connections, 465 for SSL connections, 589 for TLS connections.
$config['email.smtp.auth'] = true; // Almost all email servers require authentication nowadays. Gmail does.
$config['email.smtp.login'] = $config['email.to']; //Please enter your SMTP login here. It is equal to email usually. Defaults your email.
$config['timezone'] = "GMT"; //requred for sending outgoing emails.