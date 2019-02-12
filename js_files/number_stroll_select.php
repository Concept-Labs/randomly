<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `stroll` WHERE email_user_recipient='$user_email'");
$num = mysqli_num_rows($res);

echo $num; ?>
