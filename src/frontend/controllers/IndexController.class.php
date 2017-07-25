<?php

class IndexController extends AbstractController {

	public function indexAction($params)
	{
        $manager = new Manager();
        $films = $manager->lastFilms(10);
        $actors = $manager->lastActors(10);
        $view = new View('index', 'index');
        $view->assign('listOfFilms', $films);
        $view->assign('listOfActors', $actors);
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
