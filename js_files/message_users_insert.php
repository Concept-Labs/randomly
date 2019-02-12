<?php
if (isset($_POST['mess']) && !empty($_POST['mess']) && $_POST['mess'] != ' ') {
	session_start();

	require ('db.php' );
	$dialog = $_SESSION['dialog'];
	$user_email = $_SESSION['login'];
	$email_fate = $_SESSION['email_fate'];
	$message = $_POST['mess'];
	$reading_message = '0';

	$query_sender_message = "INSERT INTO `chat_users`(`id`, `kod_dialog`, `email_sender_message`, `email_recipient_message`, `message_sender`, `reading_message`, `date_posting`, `time_posting`) VALUES (null,'$dialog','$user_email','$email_fate','$message','$reading_message',NOW(),NOW())";
	mysqli_query($db, $query_sender_message);

}