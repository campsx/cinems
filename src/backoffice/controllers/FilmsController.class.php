<?php

class FilmsController{

	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'films/list');
		exit();
	}

	public function listAction($params)
	{
		$view = new View('films', 'list', 'backoffice');
	}

	public function createAction($params)
	{
		$view = new View('films', 'create', 'backoffice');
	}

	public function editAction($params)
	{
		$view = new View('films', 'edit', 'backoffice');
	}

	// @Todo: remove par requete sur list ou sa propre url avec redirection ??

}
