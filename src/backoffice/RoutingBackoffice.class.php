<?php

class RoutingBackoffice extends AbstractRouting {

	public function __construct($uriExploded){
        parent::__construct($uriExploded);

        // check if user is admin
	    if(!(isset($uriExploded[1]) && $uriExploded[1] === 'index' && isset($uriExploded[2]) && $uriExploded[2] === 'login')
            && !$this->request->session()->isRole(Session::ROLE_ADMIN)){
            $response = new Response();
            $response->redirectionbackoffice('index/login', 401);
        }
		$this->basePathController = ROOT_DIR.'src/backoffice/controllers/';

		$this->setController(1);
		$this->setAction(2);
		unset($this->uriExploded[0]);
		$this->setParams();
		$this->runRoute();
	}

}
