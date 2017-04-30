<?php
abstract class AbstractRouting {

	protected $uriExploded;
	protected $controller;
	protected $controllerName;
	protected $action;
	protected $actionName;
	protected $params;
	protected $basePathController = 'src/frontend/controllers/';

	protected $request;

	public function __construct($uriExploded)
	{
		$this->uriExploded = $uriExploded;
        $this->request = Request::getInstance();
	}

	public function setController($index = 0)
	{
		$this->controller = (empty($this->uriExploded[$index]))?"Index":ucfirst($this->uriExploded[$index]);
		$this->controllerName = $this->controller."Controller";
		unset($this->uriExploded[$index]);
	}

	public function setAction($index = 1)
	{
		$this->action = (empty($this->uriExploded[$index]))?"index":$this->uriExploded[$index];
		$this->actionName = $this->action."Action";
		unset($this->uriExploded[$index]);
	}

	public function setParams()
	{
		$this->params = array_merge(array_values($this->uriExploded), $_POST);
	}

	public function checkRoute()
	{
		$pathController = $this->basePathController.$this->controllerName.".class.php";

		if( !file_exists($pathController) ){
			//echo "Le fichier du controller n'existe pas";
			return false;
		}
		include $pathController;

		if (!class_exists($this->controllerName)){
			//echo "Le fichier du controller existe mais il n'y a pas de classe";
			return false;
		}
		if(!method_exists($this->controllerName, $this->actionName)){
			//echo "L'action n'existe pas";
			return false;
		}
		return true;
	}


	public function runRoute()
	{
		if ($this->checkRoute()) {
			$controller = new $this->controllerName();
			$controller->{$this->actionName}($this->params);
		} else {
			$this->page404();
		}
	}

	public function page404()
	{
		require $this->basePathController."IndexController.class.php";
		$controller = new IndexController();
		$controller->page404Action($this->params);
	}


}
