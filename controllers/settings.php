<?php
Class Controller_Settings Extends Controller_Base 
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

    $template = $this->_initTemplate($settings_page, '');

    $template->setFile('templates/settings.phtml');
    
    $template->set('row_user', $row_user);

        //--редактирования данных--
    $result_more_info_select = mysqli_query($db, "SELECT * FROM `more_info_users` WHERE email='$user_email'");
    $row_more_info_select = mysqli_fetch_array($result_more_info_select); 
    $num_more_info_select = mysqli_num_rows($result_more_info_select);
    if (isset($_POST['save_edit'])) {
        $name = strip_tags($_POST['name']);
        $nickname = strip_tags($_POST['nickname']);
        $date_birth = $_POST['date_birth'];
        $city = strip_tags($_POST['city']);
        $orientation = $_POST['orientation'];
        $sex = $_POST['sex'];
        $language = $_POST['language'];

        $sharp = $_POST['sharp'];
        $weight = $_POST['weight'];
        $eyes = $_POST['eyes'];
        $hair = $_POST['hair'];
        $hobby = $_POST['hobby'];
        $purpose_life = $_POST['purpose_life'];
        $religion = $_POST['religion'];

        if (!empty($name) && !empty($date_birth) && !empty($city) && !empty($orientation)) {
            $query_edit = "UPDATE `registered_users` SET `sex`='$sex',`name`='$name',`nickname`='$nickname',`date_birth`='$date_birth',`city`='$city',`orientation`='$orientation',`language`='$language' WHERE email='$user_email'";
            $result_edit = mysqli_query($db, $query_edit);
            if ($num_more_info_select != 0) {
                $query_more_info = "UPDATE `more_info_users` SET `sharp`='$sharp',`weight`='$weight',`eyes`='$eyes',`hair`='$hair',`hobby`='$hobby',`purpose_life`='$purpose_life',`religion`='$religion' WHERE email='$user_email'"; 
                $result_more_info = mysqli_query($db, $query_more_info); 
            } else {
                $query_more_info_insert = "INSERT INTO `more_info_users`(`id`, `email`, `sharp`, `weight`, `hair`, `eyes`, `hobby`, `purpose_life`, `religion`) VALUES (null,'$user_email','$sharp','$weight','$hair','$eyes','$hobby','$purpose_life','$religion')"; 
                $result_more_info_insert = mysqli_query($db, $query_more_info_insert); 
            }

            header("Refresh:0");
        }
    }
    $template->set('row_more_info_select', $row_more_info_select);

    $this->_renderLayout($template, true);
}         
}
