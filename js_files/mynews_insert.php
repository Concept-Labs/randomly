<?php
session_start();
require ('db.php' );
$user_email = $_SESSION['login'];
$kod_news = rand();
if (isset($_POST['text_news']) && !empty($_POST['text_news']) && $_POST['text_news'] != ' ') {
	
	$text_news = $_POST['text_news'];

	$query_text_news = "INSERT INTO `news_users`(`id`, `email_user_news`, `kod_news`, `text_news`, `date_news`) VALUES (null,'$user_email','$kod_news','$text_news',NOW())";
	mysqli_query($db, $query_text_news);

}

if(isset($_FILES['image'])) {

	$errors_image = array();
	$filePath  = $_FILES['image']['tmp_name'];
	$errorCode = $_FILES['image']['error'];
// Проверим на ошибки
	if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

    // Массив с названиями ошибок
		$errorMessages = [
			UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
			UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
			UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
			UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
			UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
		];

    // Зададим неизвестную ошибку
		$unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
		$outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

    // Выведем название ошибки
		$errors_image = $outputMessage;
	}

	if (empty($errors_image)) {
    // Создадим ресурс FileInfo
		$fi = finfo_open(FILEINFO_MIME_TYPE);

// Получим MIME-тип
		$mime = (string) finfo_file($fi, $filePath);

// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
		if (strpos($mime, 'image') === false) $errors_image = 'Можно загружать только изображения.';
	}
	if (empty($errors_image)) {
// Результат функции запишем в переменную
		$image = getimagesize($filePath);

// Зададим ограничения для картинок
		$limitBytes  = 1024 * 1024 * 5;

// Проверим нужные параметры
		if (filesize($filePath) > $limitBytes) $errors_image = 'Размер изображения не должен превышать 5 Мбайт.';
	}
	if (empty($errors_image)) {
// Сгенерируем новое имя файла на основе MD5-хеша
		$name = date('Ymd').hash('crc32',time());

// Сгенерируем расширение файла на основе типа картинки
		$extension = image_type_to_extension($image[2]);

// Сократим .jpeg до .jpg
		$format = str_replace('jpeg', 'jpg', $extension);

// Переместим картинку с новым именем и расширением в папку /pics

		if (move_uploaded_file($filePath, dirname(__DIR__) . '/gallery/news/' . $name . $format)) {
			if (empty($_POST['text_news'])) {
				$query_text_news = "INSERT INTO `news_users`(`id`, `email_user_news`, `kod_news`, `text_news`, `date_news`) VALUES (null,'$user_email','$kod_news','',NOW())";
				mysqli_query($db, $query_text_news);
			}
			$query_user_image = "INSERT INTO `gallery_news`(`id`, `email_users_news`, `kod_news`, `path_image_news`, `date_image_news`) VALUES (null,'$user_email','$kod_news','$name$format',NOW())";
			mysqli_query($db, $query_user_image);
		} else {
			$errors_image = 'При загрузке изображения произошла ошибка.';
		}
	}
	if (!empty($errors_image)) {
		echo $errors_image;
	}
}