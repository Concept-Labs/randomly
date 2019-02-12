<?php 
if (isset($_POST['like_recipient']) && !empty($_POST['like_recipient'])) {
	require ('db.php' );
	session_start();
	$user_email = $_SESSION['login'];
	$email_recipient_like = $_POST['like_recipient'];

	$res_like=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_sender_like='$user_email' AND email_recipient_like='$email_recipient_like' ");
	$num_like = mysqli_num_rows($res_like);

	if ($num_like != 0) {
		mysqli_query($db, "DELETE FROM `like_users` WHERE email_sender_like='$user_email' AND email_recipient_like='$email_recipient_like'");
	}
	else {
		mysqli_query($db, "INSERT INTO `like_users`(`id`, `email_sender_like`, `email_recipient_like`, `date_like`) VALUES (null,'$user_email','$email_recipient_like',NOW())");
	}
	
}
