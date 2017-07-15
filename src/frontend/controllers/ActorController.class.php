<?php
class ActorController{


    public function indexAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }


        $response = new Response();
        $response->redirectionFrontend('actor/view/'.$params[0], 301);
    }


    public function viewAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $actor = new Actor(['slug' => $params[0]]);

        if ($actor->getId() === null) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $view = new View('actors', 'index');
        $view->assign("actor", $actor);
    }


}
