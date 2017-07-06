<?php

class IndexController{

	public function indexAction($params)
	{

		$view = new View('index', 'index');
		
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404');
	}

}
