<?php
class Redirection {

	private $uriExploded;

	public function __construct(){
		$uri = preg_replace("#".BASE_PATH_PATTERN."#i", "", $_SERVER["REQUEST_URI"], 1);
		$this->uriExploded = explode("/",  trim($uri, "/")   );
	}

	public function runDirection(){
		if ($this->uriExploded[0] === 'admin') {
			require 'src/backoffice/RoutingBackoffice.class.php';
			$routing = new RoutingBackoffice($this->uriExploded);
		} elseif ($this->uriExploded[0] === 'api'){
            require 'src/api/RoutingApi.class.php';
            $routing = new RoutingApi($this->uriExploded);
        } else {
			require 'src/frontend/RoutingFrontend.class.php';
			$routing = new RoutingFrontend($this->uriExploded);
		}
	}

}
