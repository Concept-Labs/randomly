<?php
define ('DIRSEP', DIRECTORY_SEPARATOR);
define('base_url', 'http://' . $_SERVER['HTTP_HOST'] . DIRSEP);
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
$result_user = mysqli_query($db, $query_user);
$row_user = mysqli_fetch_array($result_user);
if (isset($row_user['language'])) {
	$lang = $row_user['language'];
	$path = '../language/'.$lang.'/templates/message.phtml';
	require($path);	

} else {
	require_once('../language/ru/templates/message.phtml');
}

if (!isset($_GET['dialog'])) {
	$query_dialog = "SELECT t1.id, t2.email as email_fate, t2.name as name_fate, t2.nickname as nickname_fate, t2.avatar_user as avatar_fate, t3.avatar_user as avatar_sender, t1.t4kod_dialog as t1kod_dialog, t1.t4email_sender_message as t1email_sender_message, t1.t4email_recipient_message as t1email_recipient_message, t1.t4message_sender as t1message_sender, t1.t4reading_message as t1reading_message, t1.t4date_posting as t1date_posting, t1.t4time_posting as t1time_posting FROM (select id, t5kod_dialog as t4kod_dialog, t5email_sender_message as t4email_sender_message, t5email_recipient_message as t4email_recipient_message, t5message_sender as t4message_sender, t5reading_message as t4reading_message, t5date_posting as t4date_posting, t5time_posting as t4time_posting from (select t5.id, t5.kod_dialog as t5kod_dialog, t5.email_sender_message as t5email_sender_message, t5.email_recipient_message as t5email_recipient_message, t5.message_sender as t5message_sender, t5.reading_message as t5reading_message, t5.date_posting as t5date_posting, t5.time_posting as t5time_posting from chat_users as t5 WHERE (t5.kod_dialog,t5.date_posting,t5.time_posting) IN(SELECT kod_dialog, date_posting, max(time_posting) FROM chat_users group by kod_dialog,date_posting) group by t5.kod_dialog,t5.date_posting) as t4 WHERE (t5kod_dialog,t5date_posting) IN(SELECT t5kod_dialog, max(t5date_posting) FROM (select t5.id, t5.kod_dialog as t5kod_dialog, t5.email_sender_message as t5email_sender_message, t5.email_recipient_message as t5email_recipient_message, t5.message_sender as t5message_sender, t5.reading_message as t5reading_message, t5.date_posting as t5date_posting, t5.time_posting as t5time_posting from chat_users as t5 WHERE (t5.kod_dialog,t5.date_posting,t5.time_posting) IN(SELECT kod_dialog, date_posting, max(time_posting) FROM chat_users group by kod_dialog,date_posting) group by t5.kod_dialog,t5.date_posting) as t5 group by t5kod_dialog) group by t5kod_dialog) as t1 JOIN `registered_users` as t2 on ((t1.t4email_sender_message = t2.email and t1.t4email_sender_message != '$user_email') or (t1.t4email_recipient_message = t2.email and t1.t4email_recipient_message != '$user_email')) JOIN `registered_users` as t3 on (t1.t4email_sender_message = t3.email) WHERE  (t1.t4email_sender_message='$user_email' OR t1.t4email_recipient_message='$user_email') ORDER BY t1.t4date_posting DESC, t1.t4time_posting DESC";
	$result_dialog = mysqli_query($db, $query_dialog);
	$num_dialog = mysqli_num_rows($result_dialog);
	$row_dialog = mysqli_fetch_all($result_dialog);
}

if ($num_dialog != 0) {
	foreach ($row_dialog as $value) {
		$kod_dialog = $value['6'];
		$query_dialog_reading = "SELECT reading_message FROM chat_users WHERE kod_dialog='$kod_dialog' AND email_recipient_message='$user_email' AND reading_message='0'";
		$result_dialog_reading = mysqli_query($db, $query_dialog_reading);
		$num_dialog_reading = mysqli_num_rows($result_dialog_reading);
		?>
		<div class="message_block_people <?php if ($value[10] == 0 && $value[7] != $row_user['email']) echo 'message_block_people_notread';?>">
			<a href="<?php echo base_url .'message?dialog='.$value['6'];?>">
				<div class="message_avatar">
					<?php if (!empty($value[3])){ ?>
					<img src="<?php echo '../gallery/users/avatars/'.$value[4] ?>">
					<?php } else { ?>
					<img src="../img/noavatar.png">
					<?php } ?>

				</div>
				<div class="message">
					<h3><?php echo $value[2]; if (!empty($value[3])) echo ' '.$value[3]; ;?></h3>
					<?php 
					if ($value[7] == $row_user['email']) {
						if (!empty($value[5])) { ?>
						<img src="<?php echo '../gallery/users/avatars/'.$value[5] ?>">
						<?php } else { ?>
						<img src="../img/noavatar.png">
						<?php } 
					}?>
					<p <?php if ($value[10] == 0 && $value[7] == $row_user['email']) echo 'class="notread_p"';?>><?php
					if (!empty($value[9])) {
						$message = $value[9];
						$counttext = 55;
						$message = mb_strimwidth($message, 0, $counttext);
						$message = rtrim($message);
						if (mb_strlen($value[9]) > $counttext) {
							echo $message.'...';
						}else {
							echo $value[9];
						} }?>
					</p>
				</div>
				<div class="date_message">

					<?php if (!empty($value[11])) {
						$date_now = strtotime(date('Y-m-d'));
						$date_message = strtotime($value[11]);
						$passed_days = floor(($date_now - $date_message)/(60*60*24));
						$date_day = date_format(date_create($value[11]), 'j');
						$date_month = date_format(date_create($value[11]), 'n')-1;
						$date_year = date_format(date_create($value[11]), 'Y');
						?>
						<?php if ($passed_days < 1) {
							echo $message_today;
						} elseif ($passed_days == 1) {
							echo $message_yesterday;
						} elseif ($passed_days > 1 && $passed_days < 182) {
							echo $date_day.' '.$arr_month_abbreviation[$date_month];
						} else {
							echo $date_day.' '.$arr_month_abbreviation[$date_month].' '.$date_year;
						}
					}?>  



				</div>
				<?php if ($num_dialog_reading != 0) {?>
				<div class="notification_message">
					<span><?php echo $num_dialog_reading; ?></span>
				</div>
				<?php } ?>
			</a>

			<div class="dell_dialog_block" id="dell_dialod_<?php echo $value[0]; ?>">
				<button class="tooltip tooltip-top" onclick="confirmation_dell_dialog(this);" data-iddialog="<?php echo $value[0]; ?>" data-tooltip='<?php echo $delete_message; ?>'>
					<i class="fas fa-times"></i>
				</button>
			</div>
		
			<div  class="overlay_del_message" id="confirmation_dell_dialog_<?php echo $value[0]; ?>" style="display: none;">
				<div class="delete_block_dialog">
					<div class="delete_dialog_top">
						<h3><?php echo $delete_dislog; ?></h3>
					</div>
					<p><?php echo $delete_dislog_2; ?> <span style="font-weight: bold;"><?php echo $delete_dislog_3; ?></span> <?php echo $delete_dislog_4; ?>
						<br>
						<br>
						<?php echo $delete_dislog_5; ?>
						 <span style="font-weight: bold;"><?php echo $delete_dislog_6; ?></span>.</p>
						<div class="delete_dialog_bottom">
							<button class="cancel_dell_dialog" onclick="cancel_dell_dialog(this);" data-iddialogcancel="<?php echo $value[0]; ?>"><?php echo $delete_dialog_button_no; ?></button>
							<button class="dell_dialog" onclick="dell_dialog(this);" data-deldialog="<?php echo $value['6']; ?>"><?php echo $delete_dialog_button_yes; ?></button>

						</div>
					</div>				
				</div>



				<!--<a href="#">
					<div class="message_spam">
						<?php echo $message_spam; ?>
					</div>
				</a>-->
			</div>
			<?php }
		} else { ?>	
		<div class="not_message">
			<i class="fas fa-mail-bulk"></i>
			<span><?php echo $no_message; ?></span>	
		</div>
		<?php } ?>