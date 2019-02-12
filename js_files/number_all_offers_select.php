<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
//Выбираем все сообщения
$res_become_acquainted = mysqli_query($db, "SELECT * FROM `become_acquainted` WHERE email_user_recipient='$user_email'");
$num_become_acquainted = mysqli_num_rows($res_become_acquainted);
$res_stroll = mysqli_query($db, "SELECT * FROM `stroll` WHERE email_user_recipient='$user_email'");
$num_stroll = mysqli_num_rows($res_stroll);
$res_sleep = mysqli_query($db, "SELECT * FROM `sleep` WHERE email_user_recipient='$user_email'");
$num_sleep = mysqli_num_rows($res_sleep);
$num = $num_become_acquainted+$num_stroll+$num_sleep;
echo $num; ?>
