<?php

class View {

  protected $view;

  protected $pathtemplate;

  protected $data = [];

  protected $template;

  /**
  * param : $dir
  * param : $view
  * param : $template
  */
  public function __construct($dir = 'index', $view = 'index', $template = "frontend") {
      $this->template = $template;
      $this->setTemplate($template);
      $this->setView($view, $dir, $template);
  }


  public function setTemplate($template)
  {
    if (file_exists("src/".$template."/views/layouts/layout.temp.php")) {
        $this->pathTemplate = "src/".$template."/views/layouts/layout.temp.php";
    } else {
        $message = "Pas de template trouver pour : %s".$template;
        Errors::error500($message);
    }
  }

  public function setView($view, $dir, $template)
  {
    if (file_exists("src/".$template."/views/".$dir."/".$view.".temp.php")) {
        $this->view ="src/".$template."/views/".$dir."/".$view.".temp.php";
    } else {
        $message = "Pas de view trouver pour le template : ".$template." | dir : ".$dir." | view : ".$view;
        Errors::error500($message);
    }
  }

  public function assign($key, $value)
  {
    $this->data[$key] = $value;
  }

  public function includeModal($modal, $config) {
      if (file_exists("src/".$this->template."/views/modals/".$modal.".mod.php")) {
          include "src/".$this->template."/views/modals/".$modal.".mod.php";
      } else {
          $message = "Le modal n'existe pas pour template : ".$this->template." | modal : ".$modal;
          Errors::error500($message);
      }
  }

 public function __destruct() {
   extract($this->data);
   include $this->pathTemplate;
 }

}
