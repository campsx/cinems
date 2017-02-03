<?php

class View {

  protected $view;

  protected $pathtemplate;

  protected $data = [];

  /**
  * param : $dir
  * param : $view
  * param : $template
  */
  public function __construct($dir = 'index', $view = 'index', $template = "frontend") {
    $this->setTemplate($template);
    $this->setView($view, $dir, $template);
  }


  public function setTemplate($template)
  {
    if (file_exists("src/".$template."/views/layouts/layout.temp.php")) {
        $this->pathTemplate = "src/".$template."/views/layouts/layout.temp.php";
    } else {
        die("Pas de template");
    }
  }

  public function setView($view, $dir, $template)
  {
    if (file_exists("src/".$template."/views/".$dir."/".$view.".temp.php")) {
        $this->view ="src/".$template."/views/".$dir."/".$view.".temp.php";
    } else {
        die("Pas de view");
    }
  }

  public function assign($key, $value)
  {
    $this->data[$key] = $value;
  }

 public function __destruct() {
   extract($this->data);
   include $this->pathTemplate;
 }

}
