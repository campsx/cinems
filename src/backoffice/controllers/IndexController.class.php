<?php

class IndexController{

	public function indexAction($params, $request)
	{
		$view = new View('index', 'index', 'backoffice');
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404', 'backoffice');
	}

	public function loginAction($params, $request)
    {
        $manager = new Manager($request);
        $query = $request->getPOSTQuery();
        if ($request->isPOSTRequest() && $manager->checkConnection($query['email'], $query['password'])){
            header('Status: 200 connexion', false, 200);
            header('Location: '.URL_WEBSITE_ADMIN.'index/index');
            exit();
        }

        $view = new View('index', 'login', 'backoffice', false);
    }

    public function disconnectAction($params, $request)
    {
        $request->session()->destroySession();
        header('Status: 200 connexion', false, 200);
        header('Location: '.URL_WEBSITE_ADMIN.'index/login');
        exit();
    }



}
