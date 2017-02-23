<?php
class ImagesController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'images/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('images', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('images', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('images', 'edit', 'backoffice');
	}


}
