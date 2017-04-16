<?php

class IndexController{

	public function indexAction($params)
	{
	    $user = new User(["id" => 6]);

	    //dump($user);
        dump($user);
        dump($user->getComments());
        dump_exit($user);

		$view = new View('index', 'index');
		//$view->assign("form", $user->getForm());
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404');
	}

}
