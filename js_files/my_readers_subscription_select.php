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
if (isset($_POST['email_myreaders_subscription']) && !empty($_POST['email_myreaders_subscription']) && isset($_POST['id_myreaders_subscription']) && !empty($_POST['id_myreaders_subscription'])) {
	$email_recipient_myreaders = $_POST['email_myreaders_subscription'];
	$id_myreaders_subscription = $_POST['id_myreaders_subscription'];

	$res_subscription = mysqli_query($db, "SELECT * FROM `subscription_users` WHERE email_sender_subscription='$user_email' AND email_recipient_subscription='$email_recipient_myreaders'");
	$num_subscription = mysqli_num_rows($res_subscription);
	?>

	<?php if ($_SESSION['subscription'] == 'my') {?>	
		<button <?php if ($num_subscription == 1) echo 'class="subscription_minus"'; ?> data-emailmyreaders="<?php echo $email_recipient_myreaders; ?>" data-idmyreaders="<?php echo $id_myreaders_subscription; ?>" onclick="send_myreaders_subscription(this);">
			<?php if ($num_subscription == 1) {
				echo $unsubscribe_button;
			}
			else {
				echo $title_subscribe;
			} ?>
		</button>
		<?php }
	elseif ($_SESSION['subscription'] == 'friends') {?>
<button <?php if ($num_subscription == 1) echo 'class="subscription_minus"'; ?> data-emailmyreaders="<?php echo $email_recipient_myreaders; ?>" data-idmyreaders="<?php echo $id_myreaders_subscription; ?>" onclick="send_myreaders_subscription(this);">
			<?php if ($num_subscription == 1) {
				echo $delete_friend;
			}
			else {
				echo $add_friend;
			} ?>
		</button>
	<?php } ?>

	<?php } ?>