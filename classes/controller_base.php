<?php
Abstract Class Controller_Base 
{
  protected $_registry;
  protected $_baseTemplate = null;
  protected $_session = null;

  function __construct($registry) 
  {
    if(!$this->_session){
      $this->_session = session_start();
    }
    $this->_registry = $registry;
    $this->_baseTemplate = $this->_registry->get('template');
  }


  abstract function index();

  protected function _initTemplate($title, $description)
  {
    $this->_baseTemplate->addCss('styles/header.css');
    $this->_baseTemplate->addCss('styles/style.css');
    $this->_baseTemplate->addCss('styles/emoji.css');
    $this->_baseTemplate->addCss('styles/main.css');
    $this->_baseTemplate->addCss('styles/registration.css');
    $this->_baseTemplate->addCss('styles/lightbox.min.css');
    $this->_baseTemplate->addCss('styles/lightbox.min.css');
    $this->_baseTemplate->addCss('styles/tooltip.css');
    $this->_baseTemplate->addCss('styles/lightslider.css');
    $this->_baseTemplate->addCss('styles/lightgallery.css');
    $this->_baseTemplate->addCss('styles/right_sideblock.css');
    $this->_baseTemplate->addCss('styles/find_page.css');
    $this->_baseTemplate->addCss('styles/fm.revealator.jquery.css.css');
    $this->_baseTemplate->addJs('script/emoji.js');
    $this->_baseTemplate->addJs('script/jquery-3.3.1.min.js');
    $this->_baseTemplate->addJs('script/prefix_free.js');
    $this->_baseTemplate->addJs('script/revealator_jQuery_plugin.js');
    $this->_baseTemplate->addJs('script/index.js');
    $this->_baseTemplate->addJs('script/upload.js');
    $this->_baseTemplate->addJs('script/lg-thumbnail.js');
    $this->_baseTemplate->addJs('script/countChar.js');
    $this->_baseTemplate->addJs('script/leftblock.js');
    $this->_baseTemplate->addJs('script/rightblock.js');
    switch (parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)) {
      case '/search_users':
      $this->_baseTemplate->addCss('styles/search_users.css');
      $this->_baseTemplate->addJs('script/efect_search_users.js');
      $this->_baseTemplate->addJs('script/contentefeckts.js');
      $this->_baseTemplate->addJs('script/search_users.js');
      break;
      case '/message':
      $this->_baseTemplate->addCss('styles/message.css');
      $this->_baseTemplate->addCss('styles/message2.scss');
      $this->_baseTemplate->addCss('styles/message_calendar.css');
      $this->_baseTemplate->addJs('script/message_calendar.js');
      $this->_baseTemplate->addJs('script/message.js');
      break;
      case '/settings':
      $this->_baseTemplate->addCss('styles/settings.css');
      break;
      case '/subscription':
      $this->_baseTemplate->addCss('styles/subscription.css');
      $this->_baseTemplate->addJs('script/subscription.js');
      break;
      case '/photo_gallery':
      $this->_baseTemplate->addCss('styles/photo_gallery.css');
      break;
      case '/your_fate':
      $this->_baseTemplate->addCss('styles/your_fate.css');
      break;
      case '/gift':
      $this->_baseTemplate->addCss('styles/gift.css');
      break;
      case '/news':
      $this->_baseTemplate->addCss('styles/news.css');
      $this->_baseTemplate->addJs('script/news.js');
      break;
      case '/find_fate':
      $this->_baseTemplate->addCss('styles/countChar.js');
      $this->_baseTemplate->addCss('styles/index.js');
      break;
      case '/find_friends':
      $this->_baseTemplate->addJs('script/find_friends.js');
      break;
      case '/':
      $this->_baseTemplate->addCss('styles/news.css');
      $this->_baseTemplate->addJs('script/mynews.js');
      break;
      case '/index':
      $this->_baseTemplate->addJs('script/mynews.js');
      break;
      case '/page':
      $this->_baseTemplate->addCss('styles/user_page.css');
      $this->_baseTemplate->addJs('script/user_page.js');      
      $this->_baseTemplate->addJs('script/news.js');
      break;
    }

    $parentTemplate = $this->_baseTemplate;
    $parentTemplate->set('title', $title);
    $parentTemplate->set('description', $description);
    return clone $this->_registry->get('template');
  }

  protected function _renderLayout($template, $usePhp = false)
  {
    $parentTemplate = $this->_baseTemplate;

    $headerTemplate = clone $parentTemplate;
    $headerTemplate->setFile('templates/header.phtml'); 
    $headerMenu = new Block_Menu($this->_registry);
    $headerMenu->setFile('templates/header/menu.phtml');  
    $_htmlHeaderMenu = $headerMenu->toHtmlWithPhp();
    $headerTemplate->set('headerMenu', $_htmlHeaderMenu);
    $_htmlheader = $headerTemplate->toHtmlWithPhp();
    $parentTemplate->set('header', $_htmlheader);

    $leftblockTemplate = clone $parentTemplate;
    $leftblockTemplate->setFile('templates/leftblock.phtml');
    $_htmlleftblock = $leftblockTemplate->toHtmlWithPhp();
    $parentTemplate->set('leftblock', $_htmlleftblock);


    if($usePhp){
      $html = $template->toHtmlWithPhp();
    } else {
      $html = $template->toHtml();
    }
    $parentTemplate->set('content', $template->toHtmlWithPhp());

    $rightblockTemplate = clone $parentTemplate;
    $rightblockTemplate->setFile('templates/rightblock.phtml');
    $_htmlrightblock = $rightblockTemplate->toHtmlWithPhp();
    $parentTemplate->set('rightblock', $_htmlrightblock);

    $footerTemplate = clone $parentTemplate;
    $footerTemplate->setFile('templates/footer.phtml');
    $_htmlfooter = $footerTemplate->toHtmlWithPhp();
    $parentTemplate->set('footer', $_htmlfooter);

  }
}