<?php
Class Controller_Photo_Gallery Extends Controller_Base 
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

    $template = $this->_initTemplate($my_gallery, '');

    $template->setFile('templates/photo_gallery.phtml');

    $template->set('row_user', $row_user);

    $query_user_image_bad = "SELECT * FROM `gallery_users` WHERE email_user_gallery='$user_email'";
    $result_user_image_bad = mysqli_query($db, $query_user_image_bad);
    $num_user_image_bad = mysqli_num_rows($result_user_image_bad);
    $row_user_gallery = mysqli_fetch_all($result_user_image_bad);
    $template->set('num_user_image_bad', $num_user_image_bad);
    $template->set('row_user_gallery', $row_user_gallery);

       //--загрузка фото--
    if (isset($_FILES['upload'])) {
    // Перезапишем переменные для удобства
        $errors_image = array();
        $filePath  = $_FILES['upload']['tmp_name'];
        $errorCode = $_FILES['upload']['error'];
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
            $name = md5_file($filePath);

// Сгенерируем расширение файла на основе типа картинки
            $extension = image_type_to_extension($image[2]);

// Сократим .jpeg до .jpg
            $format = str_replace('jpeg', 'jpg', $extension);

// Переместим картинку с новым именем и расширением в папку /pics
            $number_photos = 4;
            if ($num_user_image_bad < $number_photos) {
                $query_user_image_same_name = "SELECT * FROM `gallery_users` WHERE email_user_gallery='$user_email' AND path_image='$name$format'";
                $result_user_image_same_name = mysqli_query($db, $query_user_image_same_name);
                $num_user_image_same_name = mysqli_num_rows($result_user_image_same_name);

                if ($num_user_image_same_name != 0) {
                    $plus_numeric = '_1';
                } else {
                    $plus_numeric = '';
                }
                if (move_uploaded_file($filePath, dirname(__DIR__) . '/gallery/users/' . $name .$plus_numeric . $format)) {
                    $query_user_image = "INSERT INTO `gallery_users`(`id`, `email_user_gallery`, `path_image`, `date_image`) VALUES (null,'$user_email','$name$plus_numeric$format',NOW())";
                    mysqli_query($db, $query_user_image);
                    header("Refresh:0");
                } else {
                    $errors_image = 'При загрузке изображения произошла ошибка.';
                }
            } else {
                $errors_image = 'Извините, но Вы неможете загрузить больше '.$number_photos.' фото.';
            }
        }
    }
    $template->set('errors_image', $errors_image);

    //--видалення фото--
    $id = isset($_GET['id']) ? $_GET['id'] : 0; 
    $_SESSION['id'] = $id;
    if (isset($_GET['delete_photo'])) {
        if (isset($_POST['delete_user'])) {
            if ($_POST['delete_user'] == 1) {
                $delete = mysqli_query($db, "DELETE FROM `gallery_users` WHERE email_user_gallery='$user_email' AND id='$id'");

                header("Location:" .base_url .'photo_gallery');
            } else {
                header("Location:" .base_url .'photo_gallery');
                exit();
            }
        }
    }
    if (isset($_GET['delete_avatar'])) {
        if (isset($_POST['delete_user'])) {
            if ($_POST['delete_user'] == 1) {
                $query_delete_avatar = "UPDATE `registered_users` SET `avatar_user`='' WHERE email='$user_email'";mysqli_query($db, $query_delete_avatar); 
                header("Location:" .base_url .'photo_gallery');
            } else {
                header("Location:" .base_url .'photo_gallery');
                exit();
            }
        }
    }

    $this->_renderLayout($template, true);
}
}



