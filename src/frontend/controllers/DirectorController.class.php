<?php
class DirectorController{


	public function indexAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }


        $response = new Response();
        $response->redirectionFrontend('director/view/'.$params[0], 301);
	}


    public function viewAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $director = new Director(['slug' => $params[0]]);

        if ($director->getId() === null || $director->getActive() === 0) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $director->increaseView();
        $view = new View('directors', 'index');
        $view->assign("director",$director);
    }

}
