<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_recipient_like='$user_email' ");
$num = mysqli_num_rows($res);

$res_like=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_sender_like='$user_email' AND email_recipient_like='$user_email' ");
$num_like = mysqli_num_rows($res_like);
?>


<li><a <?php if ($num_like == 1) echo "style='color:#A805C1;'"; ?> data-email="<?php echo $user_email; ?>" onclick="send_my_like(this);"><i class="fas fa-heart"></i></a>
	<ul class="likes_li">
		<li><a><?php echo $num; ?></a></li>
	</ul>
</li>



