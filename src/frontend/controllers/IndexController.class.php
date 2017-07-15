<?php

class IndexController extends AbstractController {

	public function indexAction($params)
	{
		$view = new View('index', 'index');
	}

	public function page404Action($params)
	{
        $response = new Response();
        $response->status(404);
		$view = new View('errors', 'page404');
	}

    public function disconnectAction($params)
    {
        $this->getRequest()->session()->destroySession();
        $response = new Response();
        $response->redirectionFrontend('index', 200);
    }

}
