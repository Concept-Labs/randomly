<?php
Class Controller_Search_Users Extends Controller_Base 
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

    $template = $this->_initTemplate('Результат поиска', 'Результат поиска по вашому запросу второй половинки.');

    $template->setFile('templates/search_users.phtml');

    $template->set('row_user', $row_user);

    if (isset($_POST['search_friends'])) {
      $search_query=htmlspecialchars(strip_tags(trim($_POST['search_friends_query'])));
      $query_search = '';
      $array_search_query = explode(' ', $search_query);
      foreach ($array_search_query as $key => $value) {
        if (isset($array_search_query[$key - 1])) {
          $query_search .= ' OR ';                  
        }
        $query_search .= "(`name` LIKE '%$value%' OR `nickname` LIKE '%$value%')";
      }
      $query_search_friends = "SELECT * FROM `registered_users` WHERE email NOT IN ('$user_email') AND $query_search";
      $result_user_search = mysqli_query($db, $query_search_friends);
      $num_user_search = mysqli_num_rows($result_user_search);
      $row_user_search = mysqli_fetch_array($result_user_search);
    }

      //пошук единомишлиников
    if (isset($_POST['search_users']) || isset($_POST['become_acquainted']) || isset($_POST['stroll']) || isset($_POST['sleep']) || isset($_POST['search_new_friend'])) {
      $coment_search = htmlspecialchars(quotemeta(strip_tags($_POST['coment_search'])));
      if (isset($_POST['city_search'])) {
       $_SESSION['city_search'] = $_POST['city_search'];
     }      
     $city_search = $_SESSION['city_search'];
     if (isset($_POST['age_search'])) {
       $_SESSION['age_search'] = $_POST['age_search'];
     }
     $age_search = $_SESSION['age_search'];
     if (isset($_POST['orientation_search'])) {
       $_SESSION['orientation_search'] = $_POST['orientation_search'];
     }
     $orientation_search = $_SESSION['orientation_search'];
     $date_now = date('Y-m-d');

     $sex_user = $row_user['sex'];
     switch ($sex_user) {
      case '1':
      if ($orientation_search == 'heterosexual') {
        $sex = " and sex='0'";
      } 
      else {
        $sex = '';
      }
      $sex_gl = 'lesbian';
      break;
      case '0':
      if ($orientation_search == 'heterosexual') {
        $sex = " and sex='1'";
      } else {
        $sex = '';
      }
      $sex_gl = 'gay';
      break;

    }

    if ($age_search != 0) {
      $date_birth_end = date('Y-m-d',strtotime($date_now . "-".$age_search." year"));
      $age_search_start = $age_search + 5;
      $date_birth_start = date('Y-m-d',strtotime($date_now . "-".$age_search_start." year"));
    }

    if ($city_search == 'all') {  
      $city = '';
    } else {
      $city = ' and city='."'$city_search'";
    }
    if ($age_search == 0) {  
      $date_birth = '';
    } else {
      $date_birth = " and date_birth BETWEEN" ."'$date_birth_start'" ."AND" ."'$date_birth_end'";
    }
    if ($orientation_search == 'all') {  
      $orientation = " and orientation NOT IN ('$sex_gl')";
    } else {
      $orientation =  "and orientation="."'$orientation_search'";
    }

    $query_user_search = "SELECT * FROM `registered_users` WHERE email NOT IN ('$user_email') $sex $city $date_birth $orientation ORDER BY RAND() LIMIT 1";

    $result_user_search = mysqli_query($db, $query_user_search);
    $num_user_search = mysqli_num_rows($result_user_search);
    $row_user_search = mysqli_fetch_array($result_user_search);
  }
  if (isset($_POST['search_users']) || isset($_POST['become_acquainted']) || isset($_POST['stroll']) || isset($_POST['sleep']) || isset($_POST['search_friends']) || isset($_POST['search_new_friend'])) {

    $template->set('row_user_search', $row_user_search);

    $email_user_search = $row_user_search['email'];
    $query_user_gallery = "SELECT * FROM `gallery_users` WHERE email_user_gallery='$email_user_search'";
    $result_user_gallery = mysqli_query($db, $query_user_gallery);
    $num_user_gallery = mysqli_num_rows($result_user_gallery);
    $row_user_gallery = mysqli_fetch_all($result_user_gallery);
    $template->set('num_user_gallery', $num_user_gallery);
    $template->set('row_user_gallery', $row_user_gallery);

    if (isset($_POST['search_users']) || isset($_POST['next_search_users'])) {
      $_SESSION['email_user_recipient'] = $email_user_search;
    }
    $query_users_coment = "SELECT * FROM `comment_users` WHERE email_user='$email_user_search'";
    $result_users_coment = mysqli_query($db, $query_users_coment);
    $row_users_coment = mysqli_fetch_array($result_users_coment);
    $template->set('row_users_coment', $row_users_coment);

    $query_more_info = "SELECT * FROM `more_info_users` WHERE email='$email_user_search'";
    $result_more_info = mysqli_query($db, $query_more_info);
    $row_more_info = mysqli_fetch_array($result_more_info);
    $template->set('row_more_info', $row_more_info); 

    if (!empty($coment_search)) {
      $query_user_coment_select = "SELECT * FROM `comment_users` WHERE email_user='$user_email'";
      $result_user_coment_select = mysqli_query($db, $query_user_coment_select);
      $row_user_coment_select = mysqli_fetch_array($result_user_coment_select);

      if (empty($row_user_coment_select['coment_user'])) {
       $query_user_coment = "INSERT INTO `comment_users`(`id`, `email_user`, `coment_user`, `date_comment`) VALUES (null,'$user_email','$coment_search', NOW())";
     } else {
      $query_user_coment = "UPDATE `comment_users` SET `coment_user`='$coment_search', `date_comment`=NOW() WHERE email_user='$user_email'";
    }
    $result_user_coment = mysqli_query($db, $query_user_coment);
  }
} else {
  header("Location:" .base_url);
}

//вибор знакомства
if (isset($_POST['become_acquainted']) || isset($_POST['stroll']) || isset($_POST['sleep'])) {
  if (isset($_POST['become_acquainted'])) {
    $table_relationships = 'become_acquainted';
  }
  if (isset($_POST['stroll'])) {
    $table_relationships = 'stroll';
  }
  if (isset($_POST['sleep'])) {
    $table_relationships = 'sleep';
  }
  $email_user_recipient = $_SESSION['email_user_recipient'];
  
  $query_relationships_select = "SELECT * FROM `$table_relationships` WHERE email_user_sender='$user_email' AND email_user_recipient='$email_user_recipient'";
  $result_relationships_select = mysqli_query($db, $query_relationships_select);
  $num_relationships_select = mysqli_num_rows($result_relationships_select);

  if ($num_relationships_select == 0) {
    $query_relationships = "INSERT INTO `$table_relationships`(`id`, `email_user_sender`, `email_user_recipient`, `date`) VALUES (null,'$user_email','$email_user_recipient', NOW())";
    mysqli_query($db, $query_relationships);
    echo $query_relationships;
  }
}

$this->_renderLayout($template, true);
}
}