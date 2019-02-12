<?php
Class Controller_Index Extends Controller_Base 
{
    protected function _initTemplate($title, $description)
    {
     
      return parent::_initTemplate($title, $description);
      
  }

  public function index() 
  {
      

    $db = $this->_registry->get('db');
    $user_email = $_SESSION['login'];
    $query_user = "SELECT * FROM `registered_users` WHERE email='$user_email'";
    $result_user = mysqli_query($db, $query_user);
    $row_user = mysqli_fetch_array($result_user);

    if (isset($row_user['language'])) {
        $lang = $row_user['language'];
        $path = 'language/'.$lang.'/templates/index.phtml';
        require($path); 

    } else {
        require_once('language/ru/templates/index.phtml');
    }
    
    $template = $this->_initTemplate($mypage_title, $registration_description);
    
    $template->setFile('templates/main.phtml');

    $template->set('row_user', $row_user);

    if (isset($_FILES['image_avatar'])) {
        $redirect = $_POST['redirect'];
        // Перезапишем переменные для удобства
        $errors_image_avatar = array();
        $filePath  = $_FILES['image_avatar']['tmp_name'];
        $errorCode = $_FILES['image_avatar']['error'];
// Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

    // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
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
            $errors_image_avatar = $outputMessage;
        }

        if (empty($errors_image_avatar)) {
    // Создадим ресурс FileInfo
            $fi = finfo_open(FILEINFO_MIME_TYPE);

// Получим MIME-тип
            $mime = (string) finfo_file($fi, $filePath);

// Проверим ключевое слово image (image/jpeg, image/png и т. д.)
            if (strpos($mime, 'image') === false) $errors_image_avatar = $errors_image_avatar_translate;
        }
        if (empty($errors_image_avatar)) {
// Результат функции запишем в переменную
            $image = getimagesize($filePath);

// Зададим ограничения для картинок
            $limitBytes  = 1024 * 1024 * 5;

// Проверим нужные параметры
            if (filesize($filePath) > $limitBytes) $errors_image_avatar = $errors_image_avatar_translate_2;
        }
        if (empty($errors_image_avatar)) {
// Сгенерируем новое имя файла на основе MD5-хеша
            $name = md5_file($filePath);

// Сгенерируем расширение файла на основе типа картинки
            $extension = image_type_to_extension($image[2]);

// Сократим .jpeg до .jpg
            $format = str_replace('jpeg', 'jpg', $extension);

// Переместим картинку с новым именем и расширением в папку /pics
            $plus_numeric = '-1';
                if (move_uploaded_file($filePath, dirname(__DIR__) . '/gallery/users/avatars/' . $name .$plus_numeric . $format)) {
                    $date_now = date('Y-m-d');
                    $query_user_image_avatar = "UPDATE `registered_users` SET `avatar_user`='$name$plus_numeric$format' WHERE email='$user_email'";
                    mysqli_query($db, $query_user_image_avatar);
                    header("Location: $redirect");

                } else {
                    $errors_image_avatar = $errors_image_avatar_translate_3;
                }
        }
        echo $errors_image_avatar;
    }
    $template->set('errors_image_avatar', $errors_image_avatar);
    
    
    $this->_renderLayout($template, true);
}
}