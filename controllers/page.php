<?php
Class Controller_Page Extends Controller_Base 
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

    $template = $this->_initTemplate('Page', '');

    $template->setFile('templates/page.phtml');

    $template->set('row_user', $row_user);

    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
        $query_user_page = "SELECT * FROM `registered_users` WHERE id_user ='$id_user'";
        $result_user_page = mysqli_query($db, $query_user_page);
        $row_user_page = mysqli_fetch_array($result_user_page);
        $template->set('row_user_page', $row_user_page);

        $email_user = $row_user_page['email'];
        $query_user_gallery = "SELECT * FROM `gallery_users` WHERE email_user_gallery='$email_user'";
        $result_user_gallery = mysqli_query($db, $query_user_gallery);
        $num_user_gallery = mysqli_num_rows($result_user_gallery);
        $row_user_gallery = mysqli_fetch_all($result_user_gallery);
        $template->set('num_user_gallery', $num_user_gallery);
        $template->set('row_user_gallery', $row_user_gallery);
    }

    $this->_renderLayout($template, true);
}
}