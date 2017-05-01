<?php

class IndexController{

	public function indexAction($params)
	{
	    $user = new User(["id" => 8]);
        dump($user->getRoles());
        $user = new User(["id" => 6]);
        dump($user->getRoles());
		$view = new View('index', 'index');
		$view->assign("user", $user);
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404');
	}

}
