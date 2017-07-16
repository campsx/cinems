<?php
class Redirection {

	private $uriExploded;

	public function __construct(){
		$uri = preg_replace("#".BASE_PATH_PATTERN."#i", "", $_SERVER["REQUEST_URI"], 1);
		$this->uriExploded = explode("/",  trim($uri, "/")   );
	}

	public function runDirection(){

	    if (file_exists(INSTALLER_FILE)) {

            require INSTALLER_FILE.'InstallerService.class.php';

	        if (InstallerService::testConnexion() === true && InstallerService::testFirstAdmin()) {
                //rrmdir(INSTALLER_FILE); @Todo uncomment this line in the end of the project
            } else {
                require INSTALLER_FILE.'RoutingInstaller.class.php';
                $routing = new RoutingInstaller($this->uriExploded);
                exit;
            }
        }

		if ($this->uriExploded[0] === 'admin') {
            require ROOT_DIR.'src/backoffice/RoutingBackoffice.class.php';
            $routing = new RoutingBackoffice($this->uriExploded);
		} elseif ($this->uriExploded[0] === 'api'){
            require ROOT_DIR.'src/api/RoutingApi.class.php';
            $routing = new RoutingApi($this->uriExploded);
        } else {
			require ROOT_DIR.'src/frontend/RoutingFrontend.class.php';
			$routing = new RoutingFrontend($this->uriExploded);
		}
	}

}
