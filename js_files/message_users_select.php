<?php
session_start();

require ('db.php' );
function smile($var){
	$symbol = array('B)',
		'&#128523;');
	$graph = array('<img style="width: 19px; height: auto;" src="../img/smilies/smiley_PNG192.png">',
		'<img style="width: 19px; height: auto;" src="../img/smilies/smiley_PNG194.png">');
	return str_replace($symbol, $graph, $var);
}
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

$dialog = $_SESSION['dialog'];
if (!empty($dialog)) {
	$query_reading_message = "UPDATE `chat_users` SET `reading_message`='1' WHERE kod_dialog='$dialog' AND email_recipient_message='$user_email'";
	mysqli_query($db, $query_reading_message);
}

$query_dialog_date = "SELECT id, kod_dialog, email_sender_message, email_recipient_message, date_posting FROM `chat_users` WHERE (email_sender_message='$user_email' OR email_recipient_message='$user_email') AND kod_dialog='$dialog' group by date_posting";
$result_dialog_date = mysqli_query($db, $query_dialog_date);
$num_dialog_date = mysqli_num_rows($result_dialog_date);
$row_dialog_date = mysqli_fetch_all($result_dialog_date);

if ($num_dialog_date != 0) { ?>
<ul id="message_block_ul" class="message_block_ul" onload="down()">
	<?php foreach ($row_dialog_date as $date) { 
		$date_now = strtotime(date('Y-m-d'));
		$date_message = strtotime($date[4]);
		$passed_days = floor(($date_now - $date_message)/(60*60*24));
		$date_day = date_format(date_create($date[4]), 'j');
		$date_month = date_format(date_create($date[4]), 'n')-1;
		$date_year = date_format(date_create($date[4]), 'Y');
		?>
		<div class="date_day_message">
			<?php if ($passed_days < 1) {
				echo $message_today;
			} elseif ($passed_days == 1) {
				echo $message_yesterday;
			} elseif ($passed_days > 1 && $passed_days < 182) {
				echo $date_day.' '.$arr_month[$date_month];
			} else {
				echo $date_day.' '.$arr_month[$date_month].' '.$date_year;
			} ?>
		</div>

		<?php 
		$date_mess = $date['4'];
		$query_dialog_users = "SELECT t1.id, t3.name as name_sender, t3.avatar_user as avatar_sender, t1.kod_dialog as t1kod_dialog, t1.email_sender_message as t1email_sender_message, t1.email_recipient_message as t1email_recipient_message, t1.message_sender as t1message_sender, t1.reading_message as t1reading_message, t1.date_posting as t1date_posting, t1.time_posting as t1time_posting FROM `chat_users` as t1 JOIN `registered_users` as t3 on (t1.email_sender_message = t3.email) WHERE t1.kod_dialog='$dialog' AND t1.date_posting='$date_mess' AND (t1.email_sender_message='$user_email' OR t1.email_recipient_message='$user_email')";
		$result_dialog_users = mysqli_query($db, $query_dialog_users);
		$num_dialog_users = mysqli_num_rows($result_dialog_users);
		$row_dialog_users = mysqli_fetch_all($result_dialog_users);
		
		if ($num_dialog_users != 0) {
			foreach ($row_dialog_users as $value) { ?>
			<input class="message_check" type="checkbox" id="cb1" required/> 
			<label for="cb1">
				<li <?php if ($value[7] == 0 && $value[4] == $row_user['email']) echo 'class="notread_message"';?>>
					<div class="message_block_ul_avatar">
						<?php if (!empty($value['2'])) { ?>
						<img src="<?php echo '../gallery/users/avatars/'.$value['2']; ?>">
						<?php } else { ?>
						<img src="../img/noavatar.png">
						<?php } ?>
					</div>
					<div class="message_block_ul_message">
						<h4><?php echo $value['1']; ?></h4>
						<p><?php echo nl2br(smile($value['6'])); ?></p>
						<!--<img src="../img/rain.jpg" alt="">-->
					</div>
					<div class="message_block_ul_date">
						<button onclick="send_del(this);" data-delmess="<?php echo $value[0]; ?>" data-deldialog="<?php echo $value[3]; ?>">
							<i class="far fa-trash-alt"></i>
						</button>				
						<span><?php 
						$time_mess = date_format(date_create($value[9]), 'H:i');
						echo $time_mess; ?></span>
					</div>
				</li>
			</label>
			
			<?php }
		} 
	}?>
</ul>
<button type="button" class="scroll_down" id="scroll_down"><i class="fas fa-angle-down"></i></button>
<?php }
else { ?>
<div class="not_message">
	<i class="fas fa-mail-bulk"></i>
	<span><?php echo $not_message; ?></span>
</div>
<?php } ?>
