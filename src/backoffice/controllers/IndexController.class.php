<?php

class IndexController extends AbstractController {

	public function indexAction($params)
	{
		$view = new View('index', 'index', 'backoffice');
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404', 'backoffice');
	}

	public function loginAction($params)
    {
        $manager = new Manager();
        $query = $this->getRequest()->getPOSTQuery();
        if ($this->getRequest()->isPOSTRequest() && $manager->checkConnection($query['email'], $query['password'])){
            $response = new Response();
            $response->redirectionBackoffice('index/index', 200);
        }

        $view = new View('index', 'login', 'backoffice', false);
    }

    public function disconnectAction($params)
    {
        $this->getRequest()->session()->destroySession();
        $response = new Response();
        $response->redirectionBackoffice('index/login', 200);
    }



}
