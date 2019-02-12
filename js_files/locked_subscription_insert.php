<?php 
if (isset($_POST['locked_subscription_recipient']) && !empty($_POST['locked_subscription_recipient'])) {
	require ('db.php' );
	session_start();
	$user_email = $_SESSION['login'];
	$email_recipient_subscription = $_POST['locked_subscription_recipient'];
	
	$date_now = date('Y-m-d H:i:s');

	$res_subscription=mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$email_recipient_subscription' AND email_recipient_subscription='$user_email' AND locked='YES' ");
	$num_subscription = mysqli_num_rows($res_subscription);

	if ($num_subscription != 0) {
		mysqli_query($db, "UPDATE `subscription_users` SET locked='' WHERE email_sender_subscription='$email_recipient_subscription' AND email_recipient_subscription='$user_email'");
	}
	else {
		mysqli_query($db, "UPDATE `subscription_users` SET locked='YES' WHERE email_sender_subscription='$email_recipient_subscription' AND email_recipient_subscription='$user_email'");
	}
	
}
