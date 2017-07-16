<?php

class RoutingInstaller extends AbstractRouting {

	public function __construct($uriExploded){
        dump_exit($uriExploded);
	    $uriExploded[0] = 'installer';
        parent::__construct($uriExploded);

        $this->basePathController = ROOT_DIR.'_installer/';

        $this->setController(0);
        $this->setAction(1);
        unset($this->uriExploded[0]);
        $this->setParams();
        $this->runRoute();
	}

}
