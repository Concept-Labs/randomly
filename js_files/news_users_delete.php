<?php
if (isset($_POST['idnewsconfirmation']) && !empty($_POST['idnewsconfirmation'])) {
	session_start();

	require ('db.php' );
	$user_email = $_SESSION['login'];
	$id = $_POST['idnewsconfirmation'];
	$query_delete = "DELETE FROM `news_users` WHERE email_user_news='$user_email' AND id='$id'";
	mysqli_query($db, $query_delete);

}