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

	public function addAction($params)
	{
		echo "ajout d'un utilisateur";
	}

}
