<?php
session_start();

	require ('db.php' );
	$user_email = $_SESSION['login'];
if (isset($_POST['idcommentnewsconfirmation']) && !empty($_POST['idcommentnewsconfirmation']) && isset($_POST['kodcommentnews']) && !empty($_POST['kodcommentnews'])) {
	
	$id = $_POST['idcommentnewsconfirmation'];
	$kodcommentnews = $_POST['kodcommentnews'];
	$query_delete = "DELETE FROM `comment_news` WHERE email_sender_user='$user_email' AND id='$id' AND kod_news='$kodcommentnews'";
	mysqli_query($db, $query_delete);

}

if (isset($_POST['idcommentmynewsconfirmation']) && !empty($_POST['idcommentmynewsconfirmation']) && isset($_POST['kodcommentmynews']) && !empty($_POST['kodcommentmynews'])) {
	
	$id = $_POST['idcommentmynewsconfirmation'];
	$kodcommentmynews = $_POST['kodcommentmynews'];
	$query_delete = "DELETE FROM `comment_news` WHERE email_user_news='$user_email' AND id='$id' AND kod_news='$kodcommentmynews'";
	mysqli_query($db, $query_delete);

}
?>