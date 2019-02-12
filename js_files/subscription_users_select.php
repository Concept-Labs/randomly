<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$email_recipient = $_SESSION['email_recipient'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_recipient_subscription='$email_recipient' ");
$num = mysqli_num_rows($res);

$res_subscription = mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$user_email' AND email_recipient_subscription='$email_recipient' ");
$num_subscription = mysqli_num_rows($res_subscription);
//Выводим все на экран

?>
<form action="javascript:send_subscription();">
	<input type="hidden" id="subscription_recipient" value="<?php echo $email_recipient; ?>">
	<button id="send_subscription" <?php if ($num_subscription == 1) {
		echo "style='color:#A805C1;'";
	} ?>><?php echo $num; ?><i class="fas fa-user-plus"></i></button>		
</form>

