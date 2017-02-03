<?php

class RoutingFrontend extends AbstractRouting {

	public function __construct($uriExploded){
		parent::__construct($uriExploded);

		$this->setController();
		$this->setAction();
		$this->setParams();
		$this->runRoute();
	}



}
