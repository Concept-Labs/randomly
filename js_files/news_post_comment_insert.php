<?php

if (isset($_POST['comment_news']) && !empty($_POST['comment_news']) && $_POST['comment_news'] != ' ' && isset($_POST['kodcomment']) && !empty($_POST['kodcomment']) && $_POST['kodcomment'] != ' '  && isset($_POST['emailnews']) && !empty($_POST['emailnews']) && $_POST['emailnews'] != ' ') {
	session_start();
	require ('db.php' );
	$user_email = $_SESSION['login'];
	$comment_news = $_POST['comment_news'];
	$kodcomment = $_POST['kodcomment'];
	$emailnews = $_POST['emailnews'];

	$query_text_news = "INSERT INTO `comment_news`(`id`, `email_sender_user`, `email_user_news`, `kod_news`, `comment_user`, `date_comment`) VALUES (null,'$user_email','$emailnews','$kodcomment','$comment_news',NOW())";
	mysqli_query($db, $query_text_news);

}