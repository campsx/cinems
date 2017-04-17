<?php

class RoutingFrontend extends AbstractRouting {

	public function __construct($uriExploded, $request){
		parent::__construct($uriExploded);

		$this->setController();
		$this->setAction();
		$this->setParams();
		$this->runRoute($request);
	}

}
