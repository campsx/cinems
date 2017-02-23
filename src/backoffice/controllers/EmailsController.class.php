<?php
class EmailsController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'emails/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('emails', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('emails', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('emails', 'edit', 'backoffice');
	}


}
