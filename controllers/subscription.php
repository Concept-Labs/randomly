<?php
Class Controller_Subscription Extends Controller_Base 
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
    
    $template = $this->_initTemplate($my_subscription, '');
    
    $template->setFile('templates/subscription.phtml');

    $template->set('row_user', $row_user);

    $email_user = $row_user['email'];

   
        $query_user_readers_subscription = "SELECT t1.id, t2.name, t2.nickname, t2.avatar_user, t2.date_birth, t1.email_sender_subscription, t1.locked, t1.date_subscription FROM `subscription_users` as t1 JOIN `registered_users` as t2 on t1.email_sender_subscription = t2.email WHERE email_recipient_subscription='$email_user' ORDER BY id DESC";
        $result_user_readers_subscription = mysqli_query($db, $query_user_readers_subscription);
        $num_user_readers_subscription = mysqli_num_rows($result_user_readers_subscription);
        $row_user_readers_subscription = mysqli_fetch_all($result_user_readers_subscription);
        $template->set('num_user_readers_subscription', $num_user_readers_subscription);
        $template->set('row_user_readers_subscription', $row_user_readers_subscription);
    
        $query_user_subscription = "SELECT t1.id, t2.name, t2.nickname, t2.avatar_user, t2.date_birth, t1.email_recipient_subscription, t1.locked, t1.date_subscription FROM `subscription_users` as t1 JOIN `registered_users` as t2 on t1.email_recipient_subscription = t2.email WHERE email_sender_subscription='$email_user' ORDER BY id DESC";
        $result_user_subscription = mysqli_query($db, $query_user_subscription);
        $num_user_subscription = mysqli_num_rows($result_user_subscription);
        $row_user_subscription = mysqli_fetch_all($result_user_subscription);
        $template->set('num_user_subscription', $num_user_subscription);
        $template->set('row_user_subscription', $row_user_subscription);
        

    $this->_renderLayout($template, true);
}
}