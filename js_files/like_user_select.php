<?php
session_start();

require ('db.php' );
$user_email = $_SESSION['login'];
//Выбираем все сообщения
$res=mysqli_query($db, "SELECT * FROM `like_users` WHERE email_recipient_like='$user_email' ");
$num = mysqli_num_rows($res);

?>

	<?php echo $num; ?>




