<?php 
session_start();
if (isset($_SESSION['hide_pyramid'])) {
		unset($_SESSION['hide_pyramid']);
	}
	else {
		$_SESSION['hide_pyramid'] = 'hide_pyramid';
	}

 ?>