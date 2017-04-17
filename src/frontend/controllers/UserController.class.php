<?php
class UserController{


	public function indexAction()
	{
        $response = new Response();
        $response->redirectionFrontend('user/profil', 301);
	}

	public function profilAction($params)
	{
		$view = new View('users', 'profil');
	}

	public function inscriptionAction($params, $request)
	{
	    $user = new User();

	    $form = new formValidation($user, 'inscription', $request);

	    if ($form->valid()){
            $user->save();
            $response = new Response();
            $response->redirectionFrontend('user/valid', 200);
        }

        $view = new View('users', 'inscription');
	    $view->assign("errors", $form->getErrors());
	    $view->assign("request", $request);
        $view->assign("form", $user->inscriptionForm());
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
