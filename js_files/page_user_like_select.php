<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$email_recipient = $_SESSION['email_user_page'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_recipient_like='$email_recipient' ");
$num = mysqli_num_rows($res);

$res_like=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_sender_like='$user_email' AND email_recipient_like='$email_recipient' ");
$num_like = mysqli_num_rows($res_like);
//Выводим все на экран

?>
<ul class="likes">
	<li><a <?php if ($num_like != 0) echo "style='color: #A805C1';";?> data-email="<?php echo $email_recipient; ?>" onclick="send_like(this);"><i class="fas fa-heart"></i></a>
		<ul class="likes_li">
			<li><a><?php echo $num; ?></a></li>
		</ul>
	</li>
</ul>

