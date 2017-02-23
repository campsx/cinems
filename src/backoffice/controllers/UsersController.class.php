<?php
class UsersController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'users/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('users', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('users', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('users', 'edit', 'backoffice');
	}


}
