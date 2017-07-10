<?php


class IndexController extends AbstractController {

    public function page404Action($params)
    {
        $response = new Response();
        $response->redirectionFrontend('installer/index', 301);
    }

}
