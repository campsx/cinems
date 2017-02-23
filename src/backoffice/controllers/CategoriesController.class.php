<?php

class CategoriesController{

	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'categories/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('categories', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('categories', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('categories', 'edit', 'backoffice');
	}

	// @Todo: remove par requete sur list ou sa propre url avec redirection ??

}
