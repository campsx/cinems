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
        $manager = new Manager();
        $list = $manager->listOfPaginationImage(1);
        $view = new View('images', 'list', 'backoffice');
        $view->assign('list', $list);
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
