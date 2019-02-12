<?php 
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
$result_user = mysqli_query($db, $query_user);
$row_user = mysqli_fetch_array($result_user);
if (isset($row_user['language'])) {
	$lang = $row_user['language'];
	$path = '../language/'.$lang.'/templates/main.phtml';
	require($path);	

} else {
	require_once('../language/ru/templates/main.phtml');
}
$query_news_select = "SELECT t1.id, t1.email_user_news, t2.name, t2.nickname, t2.avatar_user, t1.kod_news, t1.text_news, t1.date_news FROM `news_users` as t1 JOIN `registered_users` as t2 on t1.email_user_news = t2.email WHERE email_user_news='$user_email' ORDER BY date_news DESC";
$result_news_select = mysqli_query($db, $query_news_select);
$num_news_select = mysqli_num_rows($result_news_select);
$row_news_select = mysqli_fetch_all($result_news_select);
?>
<?php if ($num_news_select != 0) { 
	foreach ($row_news_select as $value) {	?>
	<div class="people_post">
		<div class="del_news" id="del_news_<?php echo $value[0]; ?>">
			<button data-idnews="<?php echo $value[0]; ?>" onclick="confirmation_del_news(this)">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="confirmation_del_news" id="confirmation_del_news_<?php echo $value[0]; ?>" style="display: none;">
			<button class="del_news_but" data-idnewsconfirmation="<?php echo $value[0]; ?>" onclick="send_del_news(this)">
				<?php echo $delete_news; ?></button>
				<button class="no_del_news_but" data-idnewscancel="<?php echo $value[0]; ?>" onclick="cancel_del_news(this)"><?php echo $no_delete_news; ?></button>
			</div>

			<div class="people_avatar">
				<?php if (!empty($value['4'])) { ?>
				<img src="<?php echo '../gallery/users/avatars/'.$value['4']; ?>">
				<?php } else { ?>
				<img src="../img/noavatar.png">
				<?php } ?>
			</div>
			<div class="name_people_block">
				<h3><?php echo $value['2'].' '.$value['3']; ?></h3>
				<span>
					<?php if (!empty($value[7])) {
						$date_now = strtotime(date('Y-m-d'));
						$date_news = date_format(date_create($value[7]), 'Y-m-d');
						$date_news = strtotime($date_news);
						$passed_days = floor(($date_now - $date_news)/(60*60*24));
						$time_now = strtotime(date('Y-m-d H:i:s'));
						$time_news = strtotime($value[7]);
						$passed_minute = floor(($time_now - $time_news)/(60));
						$date_day = date_format(date_create($value[7]), 'j');
						$date_month = date_format(date_create($value[7]), 'n')-1;
						$date_year = date_format(date_create($value[7]), 'Y');
						$time = date_format(date_create($value[7]), 'H:i');
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
			<div class="text_block">
				<p><?php echo $value[6]; ?></p>
			</div>
			<?php $query_gallery_news_select = "SELECT * FROM `gallery_news` WHERE email_users_news='$value[1]' AND kod_news='$value[5]'";
			$result_gallery_news_select = mysqli_query($db, $query_gallery_news_select);
			$num_gallery_news_select = mysqli_num_rows($result_gallery_news_select);
			$row_gallery_news_select = mysqli_fetch_all($result_gallery_news_select);
			switch ($num_gallery_news_select) {
				case '1':
				$class = 'photo photo_news_1';
				break;
				case '2':
				$class = 'photo photo_news_2';
				break;
				case '3':
				$class = 'photo_news_3_6_9';
				break;
				case '4':
				$class = 'photo_news_4';
				break;
				case '5':
				$class = 'photo_news_5';
				break;
				case '6':
				$class = 'photo_news_3_6_9';
				break;
				case '7':
				$class = 'photo_news_7';
				break;
				case '8':
				$class = 'photo_news_8';
				break;
				case '9':
				$class = 'photo_news_3_6_9';
				break;
				case '10':
				$class = 'photo_news_10';
				break;
				default:
				$class = 'photo_news_10';
				break;
			}
			?>
			<?php if ($num_gallery_news_select != 0) { ?>
			<div class="image_block">	
				<div class="container">
					<div>
						<?php foreach ($row_gallery_news_select as $gallery) { ?>
						<figure class="photo <?php echo $class; ?>">
							<img src="<?php echo '../gallery/news/'.$gallery[3]; ?>"/>
						</figure>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="mind">
				<button><i class="fas fa-brain"></i><p>45343</p></button>
				<button><i class="fas fa-share"></i></button>
				<span class="save_post">
					<button><i class="far fa-bookmark"></i></button>
				</span>	
			</div>
			<!-- БЛОК КОММЕНТАРИЕВ -->
			<?php 
			$query_comments_news_select = "SELECT t1.id, t1.email_sender_user, t2.name, t2.nickname, t2.avatar_user, t1.comment_user, t1.date_comment  FROM `comment_news` as t1 JOIN `registered_users` as t2 on t1.email_sender_user = t2.email WHERE email_user_news='$value[1]' AND kod_news='$value[5]' ORDER BY t1.date_comment";
			$result_comments_news_select = mysqli_query($db, $query_comments_news_select);
			$num_comments_news_select = mysqli_num_rows($result_comments_news_select);
			$row_comments_news_select = mysqli_fetch_all($result_comments_news_select);
			?>
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
						<div id="del_commentnews_<?php echo $comments[0]; ?>">
							<button class="delete_comment" data-iddelcommentnews="<?php echo $comments[0]; ?>" onclick="confirmation_del_commentnews(this);"><i class="far fa-trash-alt"></i></button>
						</div>
						<div class="confirmation_del_news" id="confirmation_del_commentnews_<?php echo $comments[0]; ?>" style="display: none;">
							<button class="del_news_but" data-idcommentnewsconfirmation="<?php echo $comments[0];?>" data-kodcommentnews="<?php echo $value[5];?>" onclick="send_del_commentnews(this);"><i class="far fa-trash-alt"></i></button>
							<button class="no_del_news_but" data-idcommentnewscancel="<?php echo $comments[0]; ?>" onclick="cancel_del_commentnews(this);"><i class="far fa-window-close"></i></button>

						</div>
					</div>
					<?php } 
				}?>
			</div>
			<!-- БЛОК ОТПРАВКИ КОММЕНТАРИЕВ -->
			<div class="write_comment">
				<div class="my_ava_comment">
					<?php if (!empty($row_user['avatar_user'])) { ?>
					<img src="<?php echo '../gallery/users/avatars/'.$row_user['avatar_user']; ?>">
					<?php } else { ?>
					<img src="../img/noavatar.png">
					<?php } ?>
				</div>
				<form action="#" method="post">
					<div 	 class="write" contenteditable="true" aria-multiline="true" data-text="Коментувати..." /></div>
					<button class="send_comment" data-idcomment="<?php echo $value[0]; ?>" data-kodcomment="<?php echo $value[5]; ?>" data-emailnews="<?php echo $value[1]; ?>" onclick="post_comment_news(this);"><i class="fas fa-share-square"></i></button>
				</form>
			</div>
		</div>
		<?php }
	} 
	else { ?>
	<div class="news_error">
		<i class="fas fa-toilet-paper"></i>
		<span><?php echo $tape_clean; ?></span>
	</div>
	<?php }
	?>

