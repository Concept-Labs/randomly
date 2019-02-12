<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set("Europe/Kiev");
ini_set('display_errors', 1);
	//error_reporting (E_ALL);
if (version_compare(phpversion(), '5.1.0', '<') == true) { die ('PHP5.1 Only'); }
    // Константы:
define ('DIRSEP', DIRECTORY_SEPARATOR);
    // Узнаём путь до файлов сайта
$site_path = realpath(dirname(__FILE__)) . DIRSEP;
define ('site_path', $site_path);
define('base_url', 'http://' . $_SERVER['HTTP_HOST'] . DIRSEP);
PHP_OS == "Windows" ||
PHP_OS == "WINNT" ? define("DS", "\\") : define("DS", "/"); 
include ( site_path .'startup.php' );
date_default_timezone_set("Europe/Kiev");
    // Создаём объект шаблонов
$template = new Template( $registry );
$registry->set ('template', $template );
    //создаем маршрутизатор для контролера
$router = new Router($registry);
$registry->set ('router', $router);
$router->setPath ( site_path . 'controllers' );
$router->delegate();
if (!isset($_SESSION['login'])) {
    $template->setFile('templates/authorization.phtml');
    echo $template->toHtmlWithPhp();
}else {
    $template->setFile('templates/index.phtml');
    echo $template->toHtml();
}


