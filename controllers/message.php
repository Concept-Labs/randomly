<?php
Class Controller_Message Extends Controller_Base 
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
    $email_user = $row_user['email'];
    if (isset($row_user['language'])) {
        $lang = $row_user['language'];
        $path = 'language/'.$lang.'/templates/index.phtml';
        require($path); 

    } else {
        require_once('language/ru/templates/index.phtml');
    }

    $template = $this->_initTemplate($message_title, '');

    $template->setFile('templates/message.phtml');

    $template->set('row_user', $row_user);
    if (isset($_GET['dialog'])) {
        $dialog = $_GET['dialog'];
        $_SESSION['dialog'] = $dialog;
        if (isset($_POST['write'])) {
            $email_send = $_POST['email_send'];
            if (!empty($email_send)) {
                $query_select_message = "SELECT * FROM `chat_users` WHERE (email_sender_message='$email_user' AND email_recipient_message='$email_send') OR (email_sender_message='$email_send' AND email_recipient_message='$email_user')";
                $result_select_message = mysqli_query($db, $query_select_message);
                $num_select_message = mysqli_num_rows($result_select_message);
                $row_select_message = mysqli_fetch_array($result_select_message);
                if ($num_select_message != 0) {
                 $kod_dialog = $row_select_message['kod_dialog'];
                 $query_dialog_header = "SELECT t1.id, t2.email as email_fate, t2.name as name_fate, t2.nickname as nickname_fate, t2.avatar_user as avatar_fate, t1.kod_dialog as t1kod_dialog, t1.email_sender_message as t1email_sender_message, t1.email_recipient_message as t1email_recipient_message FROM `chat_users` as t1 JOIN `registered_users` as t2 on ((t1.email_sender_message = t2.email and t1.email_sender_message != '$email_user') or (t1.email_recipient_message = t2.email and t1.email_recipient_message != '$email_user')) WHERE (t1.email_sender_message='$email_user' OR t1.email_recipient_message='$email_user') AND t1.kod_dialog='$kod_dialog' group by t1.kod_dialog";
                 header("Location:" .base_url .'message?dialog='.$kod_dialog);
             }
             else {
                $rand_dialog = rand();
                $_SESSION['dialog'] = $rand_dialog;
                $query_dialog_header = "SELECT id, email as email_fate, name as name_fate, nickname as nickname_fate, avatar_user as avatar_fate FROM `registered_users` WHERE email='$email_send'";
            }
        }
    } 
    else {    
       $query_dialog_header = "SELECT t1.id, t2.email as email_fate, t2.name as name_fate, t2.nickname as nickname_fate, t2.avatar_user as avatar_fate, t1.kod_dialog as t1kod_dialog, t1.email_sender_message as t1email_sender_message, t1.email_recipient_message as t1email_recipient_message FROM `chat_users` as t1 JOIN `registered_users` as t2 on ((t1.email_sender_message = t2.email and t1.email_sender_message != '$email_user') or (t1.email_recipient_message = t2.email and t1.email_recipient_message != '$email_user')) WHERE (t1.email_sender_message='$email_user' OR t1.email_recipient_message='$email_user') AND t1.kod_dialog='$dialog' group by t1.kod_dialog";
   }
   $result_dialog_header = mysqli_query($db, $query_dialog_header);
   $num_dialog_header = mysqli_num_rows($result_dialog_header);
   $row_dialog_header = mysqli_fetch_array($result_dialog_header);
   $template->set('num_dialog_header', $num_dialog_header);
   $template->set('row_dialog_header', $row_dialog_header);
   $_SESSION['email_fate'] = $row_dialog_header['email_fate'];

}



$this->_renderLayout($template, true);
}
}