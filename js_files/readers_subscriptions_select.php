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
if (isset($_POST['email_readers_subscription']) && !empty($_POST['email_readers_subscription']) && isset($_POST['id_readers_subscription']) && !empty($_POST['id_readers_subscription'])) {

$email_recipient = $_POST['email_readers_subscription'];
$id_readers_subscription = $_POST['id_readers_subscription'];

$res_subscription = mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$user_email' AND email_recipient_subscription='$email_recipient' ");
$num_subscription = mysqli_num_rows($res_subscription);
?>	

<?php if ($num_subscription != 1) { ?>
	<button data-emailreaders="<?php echo $email_recipient; ?>" data-idreaders="<?php echo $id_readers_subscription; ?>" onclick="send_subscription(this);" title="<?php echo $title_subscribe; ?>"><i class="fas fa-user-plus"></i></button>
<?php }
 else { ?>
	<button class="subscription_minus" data-emailreaders="<?php echo $email_recipient; ?>" data-idreaders="<?php echo $id_readers_subscription; ?>"  onclick="send_subscription(this);" title="<?php echo $title_subscribe_no; ?>"><i class="fas fa-user-minus"></i></button>
<?php } 
} ?>