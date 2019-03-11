<?php 
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$date_now = date('Y-m-d');
$time_now = date('H:i:s');
$query_dialog_users = "SELECT t1.id, t3.name as name_sender, t3.nickname as nickname_sender, t3.avatar_user as avatar_sender, t1.kod_dialog as t1kod_dialog, t1.email_sender_message as t1email_sender_message, t1.email_recipient_message as t1email_recipient_message, t1.message_sender as t1message_sender, t1.reading_message as t1reading_message, t1.date_posting as t1date_posting, t1.time_posting as t1time_posting FROM `chat_users` as t1 JOIN `registered_users` as t3 on (t1.email_sender_message = t3.email) WHERE t1.reading_message='0' AND t1.email_recipient_message='$user_email' AND t1.date_posting='$date_now' AND t1.time_posting='$time_now'";
$result_dialog_users = mysqli_query($db, $query_dialog_users);
$num_dialog_users = mysqli_num_rows($result_dialog_users);
$row_dialog_users = mysqli_fetch_array($result_dialog_users);
?>
<?php if ($num_dialog_users != 0) { ?>
	<div class="notice">
	<a href="#" class="notice_close">
		<i class="fas fa-times"></i>
	</a>
	<a href="#">
		<div class="notice_avatar">
			<?php if (!empty($row_dialog_users[3])) { ?>
						<img src="<?php echo '../gallery/users/avatars/'.$row_dialog_users[3]; ?>">
						<?php } else { ?>
						<img src="../img/noavatar.png">
						<?php } ?>
		</div>
		<div class="notice_message">
			<h4><?php echo $row_dialog_users[1].' '.$row_dialog_users[2]; ?></h4>
			<p><?php
					if (!empty($row_dialog_users[7])) {
						$message = $row_dialog_users[7];
						$counttext = 15;
						$message = mb_strimwidth($message, 0, $counttext);
						$message = rtrim($message);
						if (mb_strlen($row_dialog_users[7]) > $counttext) {
							echo $message.'...';
						}else {
							echo $row_dialog_users[7];
						} }?></p>

		</div>
	</a>	
</div>
<?php } ?>
