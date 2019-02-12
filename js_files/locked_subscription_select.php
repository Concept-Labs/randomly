<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
$result_user = mysqli_query($db, $query_user);
$row_user = mysqli_fetch_array($result_user);
if (isset($row_user['language'])) {
	$lang = $row_user['language'];
	$path = '../language/'.$lang.'/templates/subscription.phtml';
	require($path);	

} else {
	require_once('../language/ru/templates/subscription.phtml');
}
if (isset($_POST['email_locked_subscription']) && !empty($_POST['email_locked_subscription']) && isset($_POST['id_locked_subscription']) && !empty($_POST['id_locked_subscription'])) {
	$email_recipient_locked = $_POST['email_locked_subscription'];
	$id_locked_subscription = $_POST['id_locked_subscription'];

	$res_subscription = mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$email_recipient_locked' AND email_recipient_subscription='$user_email' AND locked='YES' ");
	$num_subscription = mysqli_num_rows($res_subscription);
	?>	
	<?php if ($num_subscription != 1) { ?>
	<button data-emaillocked="<?php echo $email_recipient_locked; ?>" data-idlocked="<?php echo $id_locked_subscription; ?>" onclick="send_locked_subscription(this);" class="block_user" title="<?php echo $title_blocked; ?>"><i class="fas fa-user-slash"></i></button>
	<?php }
	else { ?>
	<button class="subscription_no_locked" data-emaillocked="<?php echo $email_recipient_locked; ?>" data-idlocked="<?php echo $id_locked_subscription; ?>" onclick="send_locked_subscription(this);" class="block_user" title="<?php echo $title_blocked_no; ?>"><i class="far fa-handshake"></i></button>

	<?php } 
} ?>