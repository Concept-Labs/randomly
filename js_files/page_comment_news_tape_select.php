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
	
	<div class="main_comment_block">
		<?php if ($num_comments_news_select != 0) {
			foreach ($row_comments_news_select as $comments) {?>
			<div class="comment_block">
				<div class="ava_comment">
					<?php if (!empty($comments[4])) { ?>
					<img src="<?php echo '../gallery/users/avatars/'.$comments[4]; ?>">
					<?php } else { ?>
					<img src="../img/noavatar.png">
					<?php } ?>
				</div>
				<div class="text_comment">
					<h4><?php echo $comments[2].' '.$comments[3]; ?></h4>
					<p><?php echo $comments[5]; ?></p>
					<span>
						<?php if (!empty($comments[6])) {
							$date_now = strtotime(date('Y-m-d'));
							$date_news = date_format(date_create($comments[6]), 'Y-m-d');
							$date_news = strtotime($date_news);
							$passed_days = floor(($date_now - $date_news)/(60*60*24));
							$time_now = strtotime(date('Y-m-d H:i:s'));
							$time_news = strtotime($comments[6]);
							$passed_minute = floor(($time_now - $time_news)/(60));
							$date_day = date_format(date_create($comments[6]), 'j');
							$date_month = date_format(date_create($comments[6]), 'n')-1;
							$date_year = date_format(date_create($comments[6]), 'Y');
							$time = date_format(date_create($comments[6]), 'H:i');
							?>
							<?php if ($passed_minute < 1) {
								echo 'зараз';
							} elseif ($passed_days < 1) {
								echo $news_today.' о '.$time;
							} elseif ($passed_days == 1) {
								echo $news_yesterday.' о '.$time;
							} elseif ($passed_days > 1 && $passed_days < 182) {
								echo $date_day.' '.$arr_month[$date_month].' о '.$time;
							} else {
								echo $date_day.' '.$arr_month[$date_month].' '.$date_year.' о '.$time;
							}
						}?>
					</span>
				</div>
				<?php if ($row_user['email'] == $comments[1]) {?>
				<div id="del_commentnews_<?php echo $comments[0]; ?>">
					<button class="delete_comment" data-iddelcommentnews="<?php echo $comments[0]; ?>" onclick="confirmation_del_commentnews(this);"><i class="far fa-trash-alt"></i></button>
				</div>
				<div class="confirmation_del_news" id="confirmation_del_commentnews_<?php echo $comments[0]; ?>" style="display: none;">
					<button class="del_news_but" data-idcommentnewsconfirmation="<?php echo $comments[0];?>" data-kodcommentnews="<?php echo $kod_news;?>" onclick="send_del_commentnews(this);">Так</button>
					<button class="no_del_news_but" data-idcommentnewscancel="<?php echo $comments[0]; ?>" onclick="cancel_del_commentnews(this);">Ні</button>

				</div>

				<?php } ?>
			</div>
			<?php } 
		}?>
		<button class="more_commentar" data-pluscomments="1" onclick="news_users(this);">Більше коментарів <i class="fas fa-angle-down"></i></button>
	</div>

	<?php } ?>