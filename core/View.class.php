<?php

class View {

  protected $view;

  protected $pathtemplate;

  protected $data = [];

  protected $template;

  /**
   * @var Manager
   */
  protected $manager;

  /**
  * param : $dir
  * param : $view
  * param : $template
  */
  public function __construct($dir = 'index', $view = 'index', $template = "frontend", $layout = true) {
      $this->manager = new Manager();
      $this->template = $template;
      $this->setTemplate($template);
      $this->setView($view, $dir, $template);
      if (!$layout) {
          $this->pathTemplate = $this->view;
      }
  }


  public function setTemplate($template)
  {
    if (file_exists(ROOT_DIR."src/".$template."/views/layouts/layout.temp.php")) {
        $this->pathTemplate = ROOT_DIR."src/".$template."/views/layouts/layout.temp.php";
    } else {
        $message = "Pas de template trouver pour : %s".$template;
        Errors::error500($message);
    }
  }

  public function setView($view, $dir, $template)
  {
    if (file_exists(ROOT_DIR."src/".$template."/views/".$dir."/".$view.".temp.php")) {
        $this->view = ROOT_DIR."src/".$template."/views/".$dir."/".$view.".temp.php";
    } else {
        $message = "Pas de view trouver pour le template : ".$template." | dir : ".$dir." | view : ".$view;
        Errors::error500($message);
    }
  }

  public function assign($key, $value)
  {
      $this->data[$key] = $value;
  }

  private function echoRaw($value)
  {
      echo $value;
  }
  private function echoHtml($value)
  {
      echo htmlentities($value);
  }

  public function includeModal($modal, $form) {
      if (file_exists(ROOT_DIR."src/".$this->template."/views/modals/".$modal.".mod.php")) {
          include ROOT_DIR."src/".$this->template."/views/modals/".$modal.".mod.php";
      } else {
          $message = "Le modal n'existe pas pour template : ".$this->template." | modal : ".$modal;
          Errors::error500($message);
      }
  }

  /**
   * @return Request
   */
  public function getRequest()
  {
      return Request::getInstance();
  }

 public function __destruct() {
   extract($this->data);
   include $this->pathTemplate;
 }

 public function getTopActors(){
      return $this->manager->topActors();
 }

 public function getTopFilms(){
     return $this->manager->topFilms();
 }

 public function getPages(){
     return $this->manager->pageList(20);
 }

 public function commentAverage($id){
     return $this->manager->commentAverage($id);
 }


}
