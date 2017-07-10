<?php

require INSTALLER_FILE.'ViewInstaller.class.php';
require INSTALLER_FILE.'InstallerService.class.php';

class InstallerController extends AbstractController {

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionFrontend('installer/step1', 301);
	}

	// install database
	public function step1Action($params)
	{
	    if($this->getRequest()->isPOSTRequest()){

	        $query = $this->getRequest()->getPOSTQuery();
	        $data = [
	            'type' => $query['type'],
                'port' => $query['port'],
                'host' => $query['host'],
                'user' => $query['user'],
                'pwd' => $query['pwd'],
                'dbname' => $query['dbname']
            ];

            if (InstallerService::testConnexionSQL($data) !== true)
            {
                $view = new ViewInstaller('step1');
                $view->assign('error', "Probleme avec les identifiants connection à la base de donnée");
            } else if (InstallerService::testDatabase($data) === true){
                $view = new ViewInstaller('step1');
                $view->assign('error', "Le nom de base de donnée est déjà utilisé");
            } else {
                // install database
                if (InstallerService::installSQL($data, isset($query['full'])) === true) {
                    // create config.ini
                    $confData = [
                        'data_base_section' => [
                            'DB_USER' => $data['user'],
                            'DB_PWD' => $data['pwd'],
                            'DB_NAME' => $data['dbname'],
                            'DB_HOST' => $data['host'],
                            'DB_PORT' => $data['port'],
                            'DB_TYPE' => $data['type']
                        ],
                        'mod' => [
                            'ENV_TYPE' => 'prod'
                        ]
                    ];
                    $conf = fopen(__DIR__.DS."..".DS."core".DS."testconfig.ini", "w");
                    fwrite($conf, arr2ini($confData));
                    fclose($conf);
                    $response = new Response();
                    $response->redirectionFrontend('installer/step2', 200);
                }
            }

        } else {
            $view = new ViewInstaller('step1');
        }
	}

	// active email service
    public function step2Action($params)
    {
        if (InstallerService::testConnexion()){
            $response = new Response();
            $response->redirectionFrontend('installer/step1', 301);
        }
        $view = new ViewInstaller('installer', 'step2');
    }

    // create first admin user
    public function step3Action($params)
    {
        $view = new ViewInstaller('installer', 'step3');
    }
}
