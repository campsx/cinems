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

    public function pageAction($params)
    {
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('actor', empty($params[0]) ? 1 : $params[0]);
        $view = new View('actors', 'list');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
    }

    public function viewAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $actor = new Actor(['slug' => $params[0]]);

        if ($actor->getId() === null || $actor->getActive() === 0) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $actor->increaseView();
        $view = new View('actors', 'index');
        $view->assign("actor", $actor);
    }


}
