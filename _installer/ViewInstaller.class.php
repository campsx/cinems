<?php

class ViewInstaller {

  protected $view;

  protected $pathtemplate;

  protected $data = [];

  /**
  * param : $dir
  * param : $view
  * param : $template
  */
  public function __construct($view = 'index') {
      $this->setTemplate();
      $this->setView($view);
      $this->pathTemplate = $this->view;
  }


  public function setTemplate()
  {
    if (file_exists(INSTALLER_FILE."/views/layout.temp.php")) {
        $this->pathTemplate = INSTALLER_FILE."/views/layout.temp.php";
    } else {
        $message = "Pas de template trouver";
        Errors::error500($message);
    }
  }

  public function setView($view)
  {
    if (file_exists(INSTALLER_FILE."/views/".$view.".temp.php")) {
        $this->view = INSTALLER_FILE."/views/".$view.".temp.php";
    } else {
        $message = "Pas de view : ".$view;
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

 public function __destruct() {
   extract($this->data);
   include $this->pathTemplate;
 }

}
