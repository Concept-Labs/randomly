<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$email_recipient = $_SESSION['email_recipient'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_recipient_like='$email_recipient' ");
$num = mysqli_num_rows($res);

$res_like=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_sender_like='$user_email' AND email_recipient_like='$email_recipient' ");
$num_like = mysqli_num_rows($res_like);
//Выводим все на экран

?>
<button class="search_like" id="send_like" data-email="<?php echo $email_recipient; ?>" onclick="send_like(this);" <?php if ($num_like == 1) {
	echo "style='color:#A805C1;'";
} ?>><i class="fas fa-heart"></i><span><?php echo $num; ?></span></button>

