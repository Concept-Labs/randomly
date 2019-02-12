<?php
if (isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['emailuser']) && !empty($_POST['emailuser']) && isset($_POST['kodnews']) && !empty($_POST['kodnews'])) {
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
	$id_user = $_POST['iduser'];
	$emailuser = $_POST['emailuser'];
	$kodnews = $_POST['kodnews'];
	$query_news_select = "SELECT t1.id, t1.email_user_news, t2.name, t2.nickname, t2.avatar_user, t1.kod_news, t1.text_news, t1.date_news, t2.id_user FROM `news_users` as t1 JOIN `registered_users` as t2 on t1.email_user_news = t2.email WHERE email_user_news='$emailuser' AND kod_news='$kodnews' AND id_user='$id_user' ORDER BY date_news DESC";
	$result_news_select = mysqli_query($db, $query_news_select);
	$num_news_select = mysqli_num_rows($result_news_select);
	$row_news_select = mysqli_fetch_array($result_news_select);
	
	$email_users_news = $row_news_select['email_user_news'];
	$kod_news = $row_news_select['kod_news'];
	$_SESSION['kod_news'] = $kod_news;
	$_SESSION['email_users_news'] = $email_users_news;
	$query_gallery_news_select = "SELECT * FROM `gallery_news` WHERE email_users_news='$email_users_news' AND kod_news='$kod_news'";
	$result_gallery_news_select = mysqli_query($db, $query_gallery_news_select);
	$num_gallery_news_select = mysqli_num_rows($result_gallery_news_select);
	$row_gallery_news_select = mysqli_fetch_array($result_gallery_news_select);

	?>
	<?php if ($num_news_select != 0) { ?>
	<div class="open_user_post_1" onclick="close_user_post()">
		<button class="close_user_block" onclick="close_user_post()" ><i class="fas fa-times"></i></button>
	</div>
	<div id="user_post"  class="user_post_2">
		<div class="user_post_left">
			<?php if ($num_gallery_news_select != 0) { ?>
			<img src="<?php echo '../gallery/news/'.$row_gallery_news_select[3]; ?>">
			<?php } else { ?>
			<?php echo $row_news_select[6]; ?>
			<?php } ?>
		</div>
		<div class="user_post_right">
			<div class="wrapper_user">
				<main>
					<div class="information_user">
						<div class="people_avatar">
							<?php if (!empty($row_news_select['4'])) { ?>
							<img src="<?php echo '../gallery/users/avatars/'.$row_news_select['4']; ?>">
							<?php } else { ?>
							<img src="../img/noavatar.png">
							<?php } ?>
						</div>
						<div class="name_people_block">
							<h3><?php echo $row_news_select['2'].' '.$row_news_select['3']; ?></h3>
							<span>
								<?php if (!empty($row_news_select[7])) {
									$date_now = strtotime(date('Y-m-d'));
									$date_news = date_format(date_create($row_news_select[7]), 'Y-m-d');
									$date_news = strtotime($date_news);
									$passed_days = floor(($date_now - $date_news)/(60*60*24));
									$time_now = strtotime(date('Y-m-d H:i:s'));
									$time_news = strtotime($row_news_select[7]);
									$passed_minute = floor(($time_now - $time_news)/(60));
									$date_day = date_format(date_create($row_news_select[7]), 'j');
									$date_month = date_format(date_create($row_news_select[7]), 'n')-1;
									$date_year = date_format(date_create($row_news_select[7]), 'Y');
									$time = date_format(date_create($row_news_select[7]), 'H:i');
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
					</div>
					<div class="information_post">
						<?php if (!empty($row_news_select['6'])) { ?>
						<div class="text_block">
							<p><?php echo $row_news_select['6']; ?></p>
						</div>
						<?php } ?>
						<div class="comment_user_block">
						</div>
					</div>

				</main>		
			</div>
			<div class="write_coment">
				<div class="mind">
					<button><i class="fas fa-brain"></i><p>45343</p></button>
					<button><i class="fas fa-share"></i></button>
					<span class="save_post">
						<button><i class="far fa-bookmark"></i></button>
					</span>	
				</div>
				<input type="text" id="comment_window" placeholder="Коментувати...">
				<button class="send_comment" data-kodcomment="<?php echo $kod_news; ?>" data-emailnews="<?php echo $row_news_select[1]; ?>" onclick="post_comment_news_window(this);"><i class="fas fa-share-square"></i></button>
			</div>
		</div>
	</div>
	<?php } 
}?>

