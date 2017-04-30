<?php

class RoutingApi extends AbstractRouting {

	public function __construct($uriExploded){
        parent::__construct($uriExploded);

		$this->basePathController = 'src/api/controllers/';

		$this->setController(1);
		$this->setAction(2);
		unset($this->uriExploded[0]);
		$this->setParams();
		$this->runRoute();
	}

}
