<?php
class RestoreController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'restore/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('restore', 'list', 'backoffice');
	}

}
