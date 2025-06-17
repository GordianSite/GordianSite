<?php

if($_POST) {
	$name = "";
	$email = "";
	$company = "";
	$email_title = "Gordian";
	$message = "";
	$email_body = "<div>";

	if(isset($_POST['name'])) {
		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$email_body .= "<div>
							<label><b>Name:</b></label>&nbsp;<span>".$name."</span>
						</div>";
	}

	if(isset($_POST['email'])) {
		$email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		$email_body .= "<div>
							<label><b>Email:</b></label>&nbsp;<span>".$email."</span>
						</div>";
	}

	if(isset($_POST['company'])) {
		$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);
		$email_body .= "<div>
							<label><b>Company:</b></label>&nbsp;<span>".$company."</span>
						</div>";
	}

	if(isset($_POST['message'])) {
		$message = htmlspecialchars($_POST['message']);
		$email_body .= "<div>
							<label><b>Message:</b></label>
							<div>".$message."</div>
						</div>";
	}

	$recipient = "athanasios.grivakis@gmail.com"; # this email can be adjusted

	$email_body .= "</div>";

	$headers = 'MIME-Version: 1.0' . "\r\n"
	.'Content-type: text/html; charset=utf-8' . "\r\n"
	.'From: ' . $email . "\r\n";

	if(mail($recipient, $email_title, $email_body, $headers)) {
		echo "<p>Thanks for submitting!</p>";
	} else {
		echo '<p>The message could not go through. Please try again.</p>';
	}

} else {
	echo '<p>Something went wrong</p>';
}
?>