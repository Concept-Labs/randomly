<?php
if (isset($_POST['id_mess']) && !empty($_POST['id_mess']) && isset($_POST['dialog']) && !empty($_POST['dialog'])) {
	session_start();

	require ('db.php' );
	$user_email = $_SESSION['login'];
	$id = $_POST['id_mess'];
	$dialog = $_POST['dialog'];
	$query_delete = "DELETE FROM `chat_users` WHERE (email_sender_message='$user_email' OR email_recipient_message='$user_email') AND kod_dialog='$dialog' AND id='$id'";
	mysqli_query($db, $query_delete);

}