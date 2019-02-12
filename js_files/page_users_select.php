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
if (isset($_SESSION['id_user'])) {
	$id_user = $_SESSION['id_user'];
	$query_user_page = "SELECT * FROM `registered_users` WHERE id_user='$id_user'";
	$result_user_page = mysqli_query($db, $query_user_page);
	$row_user_page = mysqli_fetch_array($result_user_page);

	$email_user = $row_user_page['email'];
	$query_user_readers_subscription = "SELECT t1.id, t2.name, t2.nickname, t2.avatar_user, t2.date_birth, t1.email_sender_subscription, t1.locked, t1.date_subscription FROM `subscription_users` as t1 JOIN `registered_users` as t2 on t1.email_sender_subscription = t2.email WHERE email_recipient_subscription='$email_user' ORDER BY id DESC";
	$result_user_readers_subscription = mysqli_query($db, $query_user_readers_subscription);
	$num_user_readers_subscription = mysqli_num_rows($result_user_readers_subscription);
	$row_user_readers_subscription = mysqli_fetch_all($result_user_readers_subscription);

	$query_user_subscription = "SELECT t1.id, t2.name, t2.nickname, t2.avatar_user, t2.date_birth, t1.email_recipient_subscription, t1.locked, t1.date_subscription FROM `subscription_users` as t1 JOIN `registered_users` as t2 on t1.email_recipient_subscription = t2.email WHERE email_sender_subscription='$email_user' ORDER BY id DESC";
	$result_user_subscription = mysqli_query($db, $query_user_subscription);
	$num_user_subscription = mysqli_num_rows($result_user_subscription);
	$row_user_subscription = mysqli_fetch_all($result_user_subscription);

	$query_more_info = "SELECT * FROM `more_info_users` WHERE email='$email_user'";
	$result_more_info = mysqli_query($db, $query_more_info);
	$row_more_info = mysqli_fetch_array($result_more_info);
	switch ($row_more_info['eyes']) {
		case 'blue':
		$eyes = 'синій';
		break;
		case 'sky_blue':
		$eyes = 'блакитний';
		break;
		case 'gray':
		$eyes = 'сірий';
		break;
		case 'green':
		$eyes = 'зелений';
		break;
		case 'amber':
		$eyes = 'бурштиновий';
		break;
		case 'fenny':
		$eyes = 'болотний';
		break;
		case 'curry':
		$eyes = 'карий';
		break;
		case 'red':
		$eyes = 'червоний';
		break;
		case 'heterochromy':
		$eyes = 'гетерохромія';
		break;
	}
	switch ($row_more_info['hair']) {
		case 'blond':
		$hair = 'блондин';
		break;
		case 'chestnut':
		$hair = 'русявий';
		break;
		case 'rufous':
		$hair = 'рудий';
		break;
		case 'brown':
		$hair = 'шатен';
		break;
		case 'brunette':
		$hair = 'брюнет';
		break;
		case 'hoary':
		$hair = 'сивий';
		break;
	}

	$query_news_select = "SELECT t1.id, t1.email_user_news, t2.name, t2.nickname, t2.avatar_user, t1.kod_news, t1.text_news, t1.date_news FROM `news_users` as t1 JOIN `registered_users` as t2 on t1.email_user_news = t2.email WHERE email_user_news='$email_user' ORDER BY date_news DESC";
	$result_news_select = mysqli_query($db, $query_news_select);
	$num_news_select = mysqli_num_rows($result_news_select);
	$row_news_select = mysqli_fetch_all($result_news_select);
}
?>
<div class="right_block">
	<p>оновлень: <?php echo $num_news_select; ?> | <a href="#">друзі: <?php $counter = 0;
	foreach ($row_user_readers_subscription as $email_read) {
		foreach ($row_user_subscription as $email_sub) {
			if ($email_read[5] == $email_sub[5]) {
				$counter += 1;
			}
		}
	}
	echo $counter; ?></a> | <a href="#">читачів: <?php echo $num_user_readers_subscription; ?></a> | <a href="#">відстежує: <?php echo $num_user_subscription; ?></a></p>
	<div class="open_more_information_users" onclick="open_more_information_users()">Больше информации о пользователе</div>
	<div class="close_more_information_users" onclick="close_more_information_users()">Скрыть информацию о пользователе</div>
	<div  id="more_information_users">
		<table>
			<tr>
				<td><?php echo $sm; ?>: <?php if (!empty($row_more_info['sharp'])) {
					echo $row_more_info['sharp'].' см';
				} else { echo $not_specified; }?></td>
				<td><?php echo $kg; ?>: <?php if (!empty($row_more_info['weight'])) {
					echo $row_more_info['weight'].' кг';
				} else { echo $not_specified; }?></td>
			</tr>
			<tr>
				<td><?php echo $color_eyes; ?>: <?php if (!empty($row_more_info['eyes'])) {
					echo $eyes;
				} else { echo $not_specified; } ?></td>
				<td><?php echo $color_heir; ?>: <?php if (!empty($row_more_info['hair'])) {
					echo $hair;
				} else { echo $not_specified; } ?></td>
			</tr>

		</table>
		<table>
			<tr>
				<td><?php echo $hobby; ?>: <?php if (!empty($row_more_info['hobby'])) {
					echo $row_more_info['hobby'];
				} else { echo $not_specified; } ?></td>
			</tr>
			<tr>
				<td><?php echo $purpose_life; ?>: <?php if (!empty($row_more_info['purpose_life'])) {
					echo $row_more_info['purpose_life'];
				} else { echo $not_specified; } ?></td>
			</tr>
			<tr>
				<td><?php echo $religion; ?>: <?php if (!empty($row_more_info['religion'])) {
					echo $row_more_info['religion'];
				} else { echo $not_specified; } ?></td>
			</tr>
		</table>
	</div>
	<div class="choing_post_user_block">
		<div class="choing_post"><a class="open_table" onclick="open_table()"><i class="fas fa-table"></i> Таблиця</a> | <a class="open_tape" data-iduser="<?php echo $id_user; ?>" data-emailuser="<?php echo $email_user; ?>" onclick="open_tape(this)"><i class="fas fa-tape"></i> Стрічка</a></div>
	</div>
	<ul class="post_user_block">
		<?php if ($num_news_select != 0){ 
			foreach ($row_news_select as $news_table) { 
				$query_gallery_news_select = "SELECT * FROM `gallery_news` WHERE email_users_news='$news_table[1]' AND kod_news='$news_table[5]'";
				$result_gallery_news_select = mysqli_query($db, $query_gallery_news_select);
				$num_gallery_news_select = mysqli_num_rows($result_gallery_news_select);
				$row_gallery_news_select = mysqli_fetch_array($result_gallery_news_select); ?>
				<li onclick="open_modal()">
					<span data-iduser="<?php echo $id_user; ?>" data-emailuser="<?php echo $news_table[1]; ?>" data-kodnews="<?php echo $news_table[5]; ?>" onclick="open_user_post(this)" class="descr"><i class="far fa-comment-alt"></i> 25 | <i class="fas fa-brain"></i> 11</span>
					<?php if ($num_gallery_news_select != 0) { ?>
					<img src="<?php echo '../gallery/news/'.$row_gallery_news_select[3]; ?>">
					<?php }
					else { ?> 

					<div class="text_left"><?php echo $news_table[6]; ?></div>	
					<?php } ?>
				</li>
				<?php } ?>
				<div id="open_user_post" style="display: none;"></div>
				<?php } ?>		
			</ul>
			<div id="news_user_tape"></div>
		</div>


					<script type="text/javascript">
						$('#open_user_post').on('shown.bs.modal', function () {
							$('html').css('overflow','hidden');
						}).on('hidden.bs.modal', function() {
							$('html').css('overflow','auto');
						});
					</script>