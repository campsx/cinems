<?php

class UserController extends AbstractController{


    /**
     * @param $params
     */
	public function indexAction()
	{
        $response = new Response();
        $response->redirectionFrontend('user/profil', 301);
	}

    /**
     * @param $params
     */
	public function profilAction($params)
	{
		$view = new View('users', 'profil');
	}

    /**
     * @param $params
     */
	public function inscriptionAction($params)
	{
	    $user = new User();
	    $form = new formValidation($user, 'inscription');

	    if ($form->valid()){
	        $user->setTokenEmail(md5(uniqid(rand(), true)));
            $user->save();

            // todo envoyer mail confirmation
            $response = new Response();
            $response->redirectionFrontend('user/valid', 200);
        }

        $view = new View('users', 'inscription');
        $view->assign("form", $form);
	}

    /**
     * @param $params
     */
    public function disconnectionAction()
    {
        $this->getRequest()->session()->destroySession();
        $view = new View('index', 'index');
    }

    /**
     * @param $params
     */
    public function loginAction()
    {
        $manager = new Manager();
        $query = $this->getRequest()->getPOSTQuery();
        if ($this->getRequest()->isPOSTRequest() && $manager->checkConnection($query['email'], $query['password'])){
            $response = new Response();
            $response->redirectionFrontend('user/profil', 200);
        }

        $view = new View('users', 'login');
        $view->assign('errors', $manager->getErrors());
    }

    /**
     * @param $params
     */
    public function validAction($params)
    {
        $view = new View('users', 'valid');
    }

    /**
     * @param $params
     */
    public function forgetAction()
    {
        $send = false;
        $error = false;
        $query = $this->getRequest()->getPOSTQuery();
        if ($this->getRequest()->isPOSTRequest() && !empty($query['email'])){
            $user = new User(["email" => $query['email']]);
            if ($user->getId() !== -1 && $user->getId() !== null){
                $user->setTokenPassword(md5(uniqid(rand(), true)));
                $date = new DateTime("+15 minutes");
                $user->setTokenExpiration($date->format(DateTime::W3C));
                $user->save();

                // Create mail and send it
                $email = new Email();
                $email->setSubject(EmailService::CHANGE_PASSWORD_SUBJECT);
                $email->setContent(EmailService::CHANGE_PASSWORD_BODY, [
                    $user->getFirstname(),
                    URL_WEBSITE."user/changepass/".$user->getTokenPassword()
                ]);
                $email->setSend(0);
                $email->setUser($user);
                $email->save();

                $emailService = new EmailService($email);

                if($emailService->sendMail()){
                    $email->setSend(1);
                    $email->save();
                    $send = true;
                } else {
                    $error = true;
                }

            }
        }

        $view = new View('users', 'forget');
        $view->assign("send", $send);
        $view->assign("error", $error);
    }

    /**
     * @param $params
     */
    public function checkmailAction($params)
    {
        $userActivate = false;
        if (isset($params[0])){
            $user = new User(["token_email" => $params[0]]);
            if ($user->getId() !== -1 && $user->getId() !== null){
                $user->setStatus(1);
                $user->save();
                $userActivate = true;
            }
        }
        $view = new View('users', 'login');
        $view->assign("userActivate", $userActivate);
    }

    /**
     * @param $params
     */
    public function changepassAction($params)
    {
        if (!isset($params[0])){
            $response = new Response();
            $response->redirectionFrontend('index/index', 401);
        }

        $user = new User(["token_password" => $params[0]]);
        if ($user->getId() === -1 || $user->getId() === null){
            $response = new Response();
            $response->redirectionFrontend('index/index', 401);
        }

        $form = new formValidation($user, 'changePassword');

        if ($form->tokenNotExpirate($user->getTokenExpiration()) && $form->valid()) {
            $user->save();
            $response = new Response();
            $response->redirectionFrontend('user/profil', 200);
        }

        $view = new View('users', 'change_pass');
        $view->assign('token', $params[0]);
        $view->assign('form', $form);

        if (!$form->tokenNotExpirate($user->getTokenExpiration())){
            $view->assign('expirate', true);
        }

    }

}
