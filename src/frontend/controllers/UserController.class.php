<?php

class UserController extends AbstractController{


	public function indexAction()
	{
        $response = new Response();
        $response->redirectionFrontend('user/profil', 301);
	}

	public function profilAction($params)
	{
		$view = new View('users', 'profil');
	}

	public function inscriptionAction($params)
	{
	    $user = new User();
	    $form = new formValidation($user, 'inscription');

	    if ($form->valid()){
            $user->save();
            // todo envoyer mail confirmation
            $response = new Response();
            $response->redirectionFrontend('user/valid', 200);
        }

        $view = new View('users', 'inscription');
        $view->assign("form", $form);
	}

    public function disconnectionAction($params)
    {
        $view = new View('users', 'disconnection');
    }

    public function connectionAction($params)
    {
        $view = new View('users', 'connection');
    }

}
