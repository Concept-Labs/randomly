<?php 
if (isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['emailuser']) && !empty($_POST['emailuser'])) {
	session_start();

	require ('db.php' );
	$user_email = $_SESSION['login'];
	$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
	$result_user = mysqli_query($db, $query_user);
	$row_user = mysqli_fetch_array($result_user);
	if (isset($row_user['language'])) {
		$lang = $row_user['language'];
		$path = '../language/'.$lang.'/templates/news.phtml';
		require($path);	

	} else {
		require_once('../language/ru/templates/news.phtml');
	}
	$iduser = $_POST['iduser'];
	$emailuser = $_POST['emailuser'];
	$query_news_select = "SELECT t1.id, t1.email_user_news, t2.name, t2.nickname, t2.avatar_user, t1.kod_news, t1.text_news, t1.date_news, t2.id_user FROM `news_users` as t1 JOIN `registered_users` as t2 on t1.email_user_news = t2.email WHERE email_user_news='$emailuser' AND id_user='$iduser' ORDER BY date_news DESC";
	$result_news_select = mysqli_query($db, $query_news_select);
	$num_news_select = mysqli_num_rows($result_news_select);
	$row_news_select = mysqli_fetch_all($result_news_select);

	?>
	<?php 
	if ($num_news_select != 0) { 
		foreach ($row_news_select as $value) {	
			?>
			<div class="people_post">
				<div class="people_avatar">
					<?php if (!empty($value['4'])) { ?>
					<img src="<?php echo '../gallery/users/avatars/'.$value['4']; ?>">
					<?php } else { ?>
					<img src="../img/noavatar.png">
					<?php } ?>
				</div>
				<!-- БЛОК ИМЕНИ И ДАТЫ ОТПРАВКИ ПОСТА -->
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
				<!-- БЛОК ТЕКСТА В ЛЕНТЕ ОБНОВЛЕНИЙ -->
				<div class="text_block">
					<?php if (!empty($value[6])) {
						$news = $value[6];
						$counttext = 5;
						$news = mb_strimwidth($news, 0, $counttext);
						$news = rtrim($news);
						if (mb_strlen($value[6]) > $counttext) { ?>
						<p id="short_news_<?php echo $value[0]; ?>"><?php echo $news.'...'; ?>
							<br/><a onclick="long_news(this);" data-idnews="<?php echo $value[0]; ?>"><?php echo $read_more; ?></a></p>
							<p id="long_news_<?php echo $value[0]; ?>" style="display: none;"><?php echo $value[6]; ?></p>
							<?php } 
							else { ?>
							<p><?php echo $value[6]; ?></p>
							<?php }
						}?>
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
					<!-- БЛОК ИЗОБРАЖЕНИЯ В ЛЕНТЕ ОБНОВЛЕНИЙ -->
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
					<div class="mind">
						<button><i class="fas fa-brain"></i><p>45343</p></button>
						<button><i class="fas fa-share"></i></button>
						<span class="save_post">
							<button><i class="far fa-bookmark"></i></button>
						</span>	
					</div>
					<?php } ?>
					<!-- БЛОК КОММЕНТАРИЕВ -->
					<div id="comments_news_tape"></div>
					<!-- БЛОК ОТПРАВКИ КОММЕНТАРИЕВ -->
					<div class="write_comment">
						<div class="my_ava_comment">
							<?php if (!empty($row_user['avatar_user'])) { ?>
							<img src="<?php echo '../gallery/users/avatars/'.$row_user['avatar_user']; ?>">
							<?php } else { ?>
							<img src="../img/noavatar.png">
							<?php } ?>
						</div>
						<form>
							<div id="comment_<?php echo $value[0]; ?>" class="write" contenteditable="true" aria-multiline="true" data-text="Коментувати..." /></div>
							<button class="send_comment" data-idcomment="<?php echo $value[0]; ?>" data-kodcomment="<?php echo $value[5]; ?>" data-emailnews="<?php echo $value[1]; ?>" onclick="post_comment_news(this);"><i class="fas fa-share-square"></i></button>
						</form>
					</div>
				</div>

				<?php }
			} 
			else { ?>
			<div class="news_error">
				<i class="fas fa-toilet-paper"></i>
				<span><?php echo $subscription_no_post; ?></span>

			</div>


			<?php }
		}