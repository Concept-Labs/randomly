<?php 
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
$query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
$result_user = mysqli_query($db, $query_user);
$row_user = mysqli_fetch_array($result_user);
if (isset($row_user['language'])) {
	$lang = $row_user['language'];
	$path = '../language/'.$lang.'/templates/rightblock.phtml';
	require($path);	

} else {
	require_once('../language/ru/templates/rightblock.phtml');
}
 ?>

 <?php if (isset($_SESSION['hide_pyramid'])) { ?>
		<div>				
			<button onclick="send_hide_pyramid();"><h3><?php echo $pyramid; ?> <i class="fas fa-angle-down"></i></h3></button> 
		</div>
		<?php }
		else { ?>     
		<div">		
			<a href="#">
				<div class="vip_pyramid">
					<span><i class="fas fa-chess-queen"></i></span>
					<p>VIP</p>	
				</div>
			</a>
			<a href="#">
				<div class="center_pyramid">
					<span><i class="fas fa-chess-knight"></i></span>
					<p>BUSINESS</p>
				</div>
			</a>
			<a href="#">
				<div class="bottom_pyramyd">
					<span><i class="fas fa-chess-pawn"></i></span>
					<p>ECONOM</p>
				</div>
			</a>
			<button class="poll"><?php echo $poll; ?></button>
			<button onclick="send_hide_pyramid();"><h3> <?php echo $hide_pyramid; ?> <i class="fas fa-angle-up"></i></h3> </button>
		</div>
		<?php } ?>