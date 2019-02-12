<?php
date_default_timezone_set("Europe/Kiev");
require ('../config.php' );
	$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname );
	mysqli_set_charset ($db , 'utf8' );
	        if (!$db) {
            echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
            echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }