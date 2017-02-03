<?php

class RoutingBackoffice extends AbstractRouting {

	public function __construct($uriExploded){
		$this->basePathController = 'src/backoffice/controllers/';
		parent::__construct($uriExploded);

		$this->setController(1);
		$this->setAction(2);
		unset($this->uriExploded[0]);
		$this->setParams();
		$this->runRoute();
	}

}
