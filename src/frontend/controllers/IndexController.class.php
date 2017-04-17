<?php

class IndexController{

	public function indexAction($params)
	{
	    $user = new User(["id" => 6]);

		$view = new View('index', 'index');
		$view->assign("form", $user->getForm());
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404');
	}

}
