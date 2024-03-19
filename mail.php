<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

    
    $mail = new PHPMailer;
    $mail->isSMTP();
    
    $mail->Host = 'relay-hosting.secureserver.net';
    $mail->Port = 25;
    $mail->SMTPAuth = false;
    
    $mail->Username = 'dezignbrain@gmail.com'; // Your Email Username
    $mail->Password = 'dezignbrain'; // Your Email Password
    
    $mail->setFrom('dezignbrain@gmail.com', 'DB Restaurant'); // Your Compnay Email
    $mail->addAddress('dezignbrain@gmail.com', 'DB Restaurant'); // Your Reciver Email address
     

	// Get the form fields and remove whitespace.
	$name = strip_tags(trim($_POST["name"]));
	$name = str_replace(array("\r","\n"),array(" "," "),$name);
	$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	$number = trim($_POST["number"]);
	$date = trim($_POST["date"]);
	$time = trim($_POST["time"]);
    $request = trim($_POST["request"]);
    $model = trim($_POST["model"]);
    $year = trim($_POST["year"]);
	// $time = trim($_POST["time"]);
   //  $persons = trim($_POST["persons"]);
	$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	// Check that data was sent to the mailer.
	if ( empty($name) OR empty($number) OR empty($date)  OR empty($time) OR empty($request) OR empty($model) OR empty($year) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// Set a 400 (bad request) response code and exit.
	 	http_response_code(400);
		echo "Please complete the form and try again.";
		 exit;
	}



    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = "New Order Received";
        $mail->isHTML(false);
        $mail->Body = <<<EOT
           This is inquiry form your site DB Restaurant
            Yourname: {$_POST['name']} 
            Number: {$_POST['number']}
            Youremail: {$_POST['email']}
            date: {$_POST['date']}
            time: {$_POST['time']}
            request: {$_POST['request']}
            model: {$_POST['model']}
            year: {$_POST['year']}
        EOT;
        if (!$mail->send()) {
                echo "Sorry, something went wrong. Please try again later.";
        } else {
            echo "Thank You! Your message has been sent.";
        }
    } else {
        echo "Please complete the form and try again.";
    };
?>
