<?php

class IndexController extends AbstractController {

	public function indexAction($params)
	{
	    return null;
	}

    public function page404Action($params)
    {
        $response = new Response();
        $response->status(404);
        return null;
    }
}
