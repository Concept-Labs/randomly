<?php
Class Controller_Authorization Extends Controller_Base 
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

    $template = $this->_initTemplate('RANDOMLY', '');

    $template->setFile('templates/authorization.phtml');
    
    if (isset($_POST['language'])) {
      $_SESSION['lang'] = $_POST['language'];
      $redirect = $_POST['redirect'];
      header("Location: $redirect");
  } 

  if (isset($_POST['register'])) {
    $id_user = rand();
    $sex = $_POST['sex'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $date_birth = $_POST['date_birth'];
    $city = $_POST['city'];
    $orientation = $_POST['orientation'];
    $agreement = $_POST['agreement'];
    $date_now = date('Y-m-d');
    $years_user = $date_now - $date_birth;

    if (isset($_SESSION['lang'])) {
     $language = $_SESSION['lang'];
 } else {
    $language = 'ru';
}

$query_email = "SELECT * FROM `registered_users` WHERE email='$email'";
$result_email= mysqli_query($db, $query_email);
$num_email = mysqli_num_rows($result_email);


if ($num_email != 0) {
    $errors['email'] = "Такой <span style='color: red;'>email</span> уже существует!"; ?>
    <input type="hidden" id="error_email" value="<?php echo $errors['email']; ?>" />
    <?php }
    elseif ($password != $password_confirm) {
       $errors['password'] = 'Потверждения пароля не совпадает с паролем!'; ?>
       <input type="hidden" id="error_password" value="<?php echo $errors['password']; ?>" />
       <?php } 
       elseif ($years_user < 16) {
        $errors['years'] = "Извините, но вам нет <span style='color: red;'>16</span> лет."; ?>
        <input type="hidden" id="error_years" value="<?php echo $errors['years']; ?>" />
        <?php }
        elseif ($agreement != 'YES') {
        $errors['agreement'] = "Извините, но Вы не согласились с <span style='color: red;'>политикой конфиденциальности</span>!"; ?>
        <input type="hidden" id="error_agreement" value="<?php echo $errors['agreement']; ?>" />
        <?php }

        if (empty($errors)) {
            $query_registered = "INSERT INTO `registered_users`(`id`, `id_user`, `email`, `sex`, `name`, `password`, `date_birth`, `city`, `orientation`, `language`, `date_registration`) VALUES (null, '$id_user', '$email', '$sex', '$name', '$password', '$date_birth', '$city', '$orientation', '$language', NOW())";
            mysqli_query($db, $query_registered);
            $query_attempt_fate = "INSERT INTO `attempt_fate`(`id`, `email_user`, `attempt_user`, `date_attempt`) VALUES (null,'$email','3',NOW())";
            mysqli_query($db, $query_attempt_fate);

            header("Location:" .base_url .'authorization?login');
        } else {
            print_r($errors); ?>
            
        <?php }
    }

    //код для входа на страніцу
    $errors_login = array();
    if (isset($_POST['login'])) {
        $email_login = trim($_POST['email_login']);
        $password_login = trim($_POST['password_login']);

        $query_email_login = "SELECT * FROM `registered_users` WHERE email='$email_login'";
        $result_email_login = mysqli_query($db, $query_email_login);
        $row_email_login = mysqli_fetch_array($result_email_login);

        if (empty(trim($_POST['email_login']))) {
            $errors_login = 'Введіть login!';
        }
        elseif (empty($row_email_login['id'])) {
            $errors_login = 'Невірний login!';
        } 
        elseif (empty($_POST['password_login'])) {
            $errors_login = 'Введіть пароль!';
        } 
        elseif (empty($row_email_login['password'] == $password_login)) {
            $errors_login = 'Невірний пароль!';
        }

        if (empty($errors_login)) {
            $_SESSION['login']=$row_email_login['email']; 
        }
        else
        {
            echo $errors_login;
        }
    }
    $template->set('errors', $errors);

    $this->_renderLayout($template, true);
}

public function logout() 
{

    $template = $this->_initTemplate('Logout to RANDOMLY', '');

    $template->setFile('templates/authorization/logout.phtml');

    $this->_renderLayout($template, true);
}
}