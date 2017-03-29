<?php
class UserController{


	public function indexAction()
	{
	    header('Status: 301 Moved Permanently', false, 301);
  	    header('Location: user/profil');
  	    exit();
	}

	public function profilAction($params)
	{
		$view = new View('users', 'profil');
	}

	public function inscriptionAction($params)
	{
        $view = new View('users', 'inscription');
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
