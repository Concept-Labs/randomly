<?php
if (isset($_POST['dialog_mess']) && !empty($_POST['dialog_mess']) && $_POST['dialog_mess'] != ' ') {
	session_start();

	require ('db.php' );
	$user_email = $_SESSION['login'];
	$dialog_mess = $_POST['dialog_mess'];
	$query_delete = "DELETE FROM `chat_users` WHERE (email_sender_message='$user_email' OR email_recipient_message='$user_email') AND kod_dialog='$dialog_mess'";
	mysqli_query($db, $query_delete);
}