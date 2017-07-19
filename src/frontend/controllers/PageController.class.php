<?php
class PageController{


    public function indexAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }


        $response = new Response();
        $response->redirectionFrontend('page/view/'.$params[0], 301);
    }


    public function viewAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $page = new Page(['slug' => $params[0]]);

        if ($page->getId() === null || $page->getActive() === 0) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $page->increaseView();
        $view = new View('pages', 'index');
        $view->assign("page", $page);
    }


}
