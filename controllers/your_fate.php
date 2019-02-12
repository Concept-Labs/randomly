<?php
Class Controller_Your_Fate Extends Controller_Base 
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
    if (isset($_GET['become_acquainted'])) {
        $title = 'Познакомится';
        $description = '';
        $table_your_fate = 'become_acquainted';
    }
    elseif (isset($_GET['stroll'])) {
        $title = 'Погулять';
        $description = '';
        $table_your_fate = 'stroll';
    }
    elseif (isset($_GET['sleep'])) {
        $title = 'Переспать';
        $description = '';
        $table_your_fate = 'sleep';
    } else {
        $title = 'Твоя судьба';
        $description = '';
    }

    $template = $this->_initTemplate($title, $description);

    $template->setFile('templates/your_fate.phtml');

    $template->set('row_user', $row_user);
    $template->set('table_your_fate', $table_your_fate);
    $template->set('relationships', $title);

    if (isset($_GET['become_acquainted']) || isset($_GET['stroll']) || isset($_GET['sleep'])) {
        $email_user = $row_user['email'];
        $query_user_attempt_fate = "SELECT * FROM `attempt_fate` WHERE email_user='$email_user'";
        $result_user_attempt_fate = mysqli_query($db, $query_user_attempt_fate);
        $row_user_attempt_fate = mysqli_fetch_array($result_user_attempt_fate);
        $template->set('row_user_attempt_fate', $row_user_attempt_fate);

        if ($row_user_attempt_fate['attempt_user'] != 0) {
            $attempt = $row_user_attempt_fate['attempt_user'] - 1;
            $query_user_attempt_fate_update = "UPDATE `attempt_fate` SET `attempt_user`='$attempt' WHERE email_user='$email_user'";
            mysqli_query($db, $query_user_attempt_fate_update);   


            $query_user_your_fate = "SELECT * FROM `$table_your_fate` WHERE email_user_recipient='$email_user' ORDER BY RAND() LIMIT 1";
            $result_user_your_fate = mysqli_query($db, $query_user_your_fate);
            $row_user_your_fate = mysqli_fetch_array($result_user_your_fate);

            $email_your_fate = $row_user_your_fate['email_user_sender'];
            $_SESSION['email_your_fate'] = $email_your_fate;
            $query_your_fate = "SELECT * FROM `registered_users` WHERE email='$email_your_fate'";
            $result_your_fate = mysqli_query($db, $query_your_fate);
            $row_your_fate = mysqli_fetch_array($result_your_fate);
            $template->set('row_your_fate', $row_your_fate); 

            $query_user_gallery = "SELECT * FROM `gallery_users` WHERE email_user_gallery='$email_your_fate'";
            $result_user_gallery = mysqli_query($db, $query_user_gallery);
            $num_user_gallery = mysqli_num_rows($result_user_gallery);
            $row_your_gallery = mysqli_fetch_all($result_user_gallery);
            $template->set('num_user_gallery', $num_user_gallery);
            $template->set('row_your_gallery', $row_your_gallery);
        }
    }
    if (isset($_GET['send_massage'])) {
     if (isset($_POST['confirm'])) {
        $email_fate = $_SESSION['email_your_fate'];
        $relationships = $_POST['relationships'];
        $message1_1 = 'Я потвердил твоё предложения "';
        $message1_2 = '", теперь мы можем узналь лучше друг друга)))';
        $message = $message1_1.$relationships.$message1_2;
        $reading_message = '0';
        $date_now = date('Y-m-d');
        $time_now = date('H:i:s');

        if (!empty($user_email) && !empty($email_fate)) {
            $query_select_message = "SELECT * FROM `chat_users` WHERE (email_sender_message='$user_email' AND email_recipient_message='$email_fate') OR (email_sender_message='$email_fate' AND email_recipient_message='$user_email')";
            $result_select_message = mysqli_query($db, $query_select_message);
            $num_select_message = mysqli_num_rows($result_select_message);
            $row_select_message = mysqli_fetch_array($result_select_message);

            if ($num_select_message != 0) {
                $kod_dialog = $row_select_message['kod_dialog'];
                $query_sender_message = "INSERT INTO `chat_users`(`id`, `kod_dialog`, `email_sender_message`, `email_recipient_message`, `message_sender`, `reading_message`, `date_posting`, `time_posting`) VALUES (null,'$kod_dialog','$user_email','$email_fate','$message','$reading_message',NOW(),NOW())";
            } else {
                $rand_number = rand();
                $query_sender_message = "INSERT INTO `chat_users`(`id`, `kod_dialog`, `email_sender_message`, `email_recipient_message`, `message_sender`, `reading_message`, `date_posting`, `time_posting`) VALUES (null,'$rand_number','$user_email','$email_fate','$message','$reading_message',NOW(),NOW())";
            }            
            mysqli_query($db, $query_sender_message);

            $table = $_POST['table'];
            mysqli_query($db, "DELETE FROM `$table` WHERE email_user_sender='$email_fate' AND email_user_recipient='$user_email'");
            header("Location:" .base_url .'message');

        }
    }
}
$this->_renderLayout($template, true);
}
}