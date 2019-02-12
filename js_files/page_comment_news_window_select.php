<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
$result_user = mysqli_query($db, $query_user);
$row_user = mysqli_fetch_array($result_user);
if (isset($row_user['language'])) {
	$lang = $row_user['language'];
	$path = '../language/'.$lang.'/templates/page.phtml';
	require($path);	

} else {
	require_once('../language/ru/templates/page.phtml');
}
if (isset($_SESSION['kod_news']) && isset($_SESSION['email_users_news'])) {
	$kod_news = $_SESSION['kod_news'];
	$email_users_news = $_SESSION['email_users_news'];
	$query_comments_news_select = "SELECT t1.id, t1.email_sender_user, t2.name, t2.nickname, t2.avatar_user, t1.comment_user, t1.date_comment  FROM `comment_news` as t1 JOIN `registered_users` as t2 on t1.email_sender_user = t2.email WHERE email_user_news='$email_users_news' AND kod_news='$kod_news' ORDER BY t1.date_comment";
	$result_comments_news_select = mysqli_query($db, $query_comments_news_select);
	$num_comments_news_select = mysqli_num_rows($result_comments_news_select);
	$row_comments_news_select = mysqli_fetch_all($result_comments_news_select); ?>
	<?php if ($num_comments_news_select != 0) {
		foreach ($row_comments_news_select as $comments_news) { ?>
		<div class="comment_user">
			<h3><?php echo $comments_news['2']; ?></h3><p><?php echo $comments_news['5']; ?></p>
		</div>
		<?php } 
	}
} ?>