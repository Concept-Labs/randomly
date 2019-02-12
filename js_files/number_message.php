<?php 

session_start();

require ('db.php' );

$user_email = $_SESSION['login'];
$query_message_reading = "SELECT reading_message FROM chat_users WHERE email_recipient_message='$user_email' AND reading_message='0'";
$result_message_reading = mysqli_query($db, $query_message_reading);
$num_message_reading = mysqli_num_rows($result_message_reading)
?>

<?php if ($num_message_reading != 0) {?>
<div class="notification">
	<?php echo $num_message_reading; ?>
</div>
<?php } ?>