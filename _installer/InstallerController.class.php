<?php

require INSTALLER_FILE.'ViewInstaller.class.php';

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
                    $conf = fopen(__DIR__.DS."..".DS."core".DS."config.ini", "w");
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
        if (InstallerService::testConnexion() !== true){
            $response = new Response();
            $response->redirectionFrontend('installer/step1', 302);
        }

        if($this->getRequest()->isPOSTRequest()){
            $query = $this->getRequest()->getPOSTQuery();
            $config = parse_ini_file(__DIR__.DS."..".DS."core".DS."config.ini", true);
            $config['email'] = [
                'EMAIL_USERNAME' => $query['email'],
                'EMAIL_PASSWORD' => $query['pwd']
            ];
            $conf = fopen(__DIR__.DS."..".DS."core".DS."config.ini", "w");
            fwrite($conf, arr2ini($config));
            fclose($conf);

            $response = new Response();
            $response->redirectionFrontend('installer/step3', 200);
        } else {
            $view = new ViewInstaller('step2');
        }
    }

    // create first admin user
    public function step3Action($params)
    {
        if (InstallerService::testConnexion() !== true){
            $response = new Response();
            $response->redirectionFrontend('installer/step1', 302);
        }

        $user = new User();
        $form = new FormValidation($user, 'firstAdmin');

        if ($form->valid()){
            $user->setTokenEmail(md5(uniqid(rand(), true)));
            $user->save();

            $response = new Response();
            $response->redirectionFrontend('index/index', 200);
        }


        $view = new ViewInstaller('step3');
        $view->assign('errors', $form->getErrors());
        $view->assign('token', $form->generateNewToken());
    }
}
