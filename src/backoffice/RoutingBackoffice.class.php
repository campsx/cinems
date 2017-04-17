<?php

class RoutingBackoffice extends AbstractRouting {

	public function __construct($uriExploded, $request){

	    if(!$request->session()->isRole(Session::$ROLE_ADMIN) && !($uriExploded[1] === 'index' && $uriExploded[2] === 'login')){
            $response = new Response();
            $response->redirectionbackoffice('index/login', 401);
        }
		$this->basePathController = 'src/backoffice/controllers/';
		parent::__construct($uriExploded);

		$this->setController(1);
		$this->setAction(2);
		unset($this->uriExploded[0]);
		$this->setParams();
		$this->runRoute($request);
	}

}
