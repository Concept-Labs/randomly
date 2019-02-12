<?php 
if ((isset($_POST['subscription_recipient']) && !empty($_POST['subscription_recipient'])) || (isset($_POST['readers_subscription_recipient']) && !empty($_POST['readers_subscription_recipient'])) || (isset($_POST['emailmyreaders']) && !empty($_POST['emailmyreaders']))) {
	require ('db.php' );
	session_start();
	$user_email = $_SESSION['login'];
	if (isset($_POST['subscription_recipient'])) {
		$email_recipient_subscription = $_POST['subscription_recipient'];
	} elseif (isset($_POST['readers_subscription_recipient'])) {
		$email_recipient_subscription = $_POST['readers_subscription_recipient'];
	} elseif (isset($_POST['emailmyreaders'])) {
		$email_recipient_subscription = $_POST['emailmyreaders'];
	}

	$res_subscription=mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$user_email' AND email_recipient_subscription='$email_recipient_subscription' ");
	$num_subscription = mysqli_num_rows($res_subscription);

	if ($num_subscription != 0) {
		mysqli_query($db, "DELETE FROM `subscription_users` WHERE email_sender_subscription='$user_email' AND email_recipient_subscription='$email_recipient_subscription'");
	}
	else {
		mysqli_query($db, "INSERT INTO `subscription_users`(`id`, `email_sender_subscription`, `email_recipient_subscription`, `date_subscription`) VALUES (null,'$user_email','$email_recipient_subscription',NOW())");
	}
	
}
