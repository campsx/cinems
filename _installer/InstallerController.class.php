<?php

require INSTALLER_FILE.'ViewInstaller.class.php';
require INSTALLER_FILE.'InstallerService.class.php';

class InstallerController extends AbstractController {

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionFrontend('installer/step1', 301);
	}

	public function step1Action($params)
	{
	    dump_exit(InstallerService::installSQL([
            'type' => 'mysql',
            'host' => 'localhost'
        ]));

	    if($this->getRequest()->isPOSTRequest()){
            if (InstallerService::testConnexionSQL([
                'type' => 'mysql',
                'host' => 'localhost',
                ''
            ])){

            }
        } else {
            $view = new ViewInstaller('installer', 'step1');
        }
	}

    public function step2Action($params)
    {
        if (InstallerService::testConnexion()){
            $response = new Response();
            $response->redirectionFrontend('installer/step1', 301);
        }
        $view = new ViewInstaller('installer', 'step2');
    }

    public function step3Action($params)
    {
        $view = new ViewInstaller('installer', 'step3');
    }
}
