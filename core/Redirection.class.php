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
			$routing = new RoutingBackoffice($this->uriExploded, new Request());
		} else {
			require 'src/frontend/RoutingFrontend.class.php';
			$routing = new RoutingFrontend($this->uriExploded, new Request());
		}
	}

}
