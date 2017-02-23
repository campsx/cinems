<?php

class DirectorsController{

	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'directors/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('directors', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('directors', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('directors', 'edit', 'backoffice');
	}

	// @Todo: remove par requete sur list ou sa propre url avec redirection ??

}
