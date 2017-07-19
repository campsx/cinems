<?php

class IndexController extends AbstractController {

	public function indexAction($params)
	{
        $manager = new Manager();
        
		$view = new View('index', 'index', 'backoffice');

		$view->assign("films", $manager->moreView('film', 5));
        $view->assign("actors", $manager->moreView('actor', 5));
        $view->assign("directors", $manager->moreView('director', 5));
	}

	public function page404Action($params)
	{
        $response = new Response();
        $response->status(404);
		$view = new View('errors', 'page404', 'backoffice');
	}

	public function loginAction()
    {
        $manager = new Manager();
        $query = $this->getRequest()->getPOSTQuery();


        if ($this->getRequest()->isPOSTRequest() &&
            $manager->checkConnection($query['email'], $query['password'])){

            $response = new Response();
            $response->redirectionBackoffice('index/index', 200);
        }

        $view = new View('index', 'login', 'backoffice', false);
        $view->assign('errors', array_merge($manager->getErrors(), $this->getRequest()->session()->getErrors()));
    }

    public function disconnectAction($params)
    {
        $this->getRequest()->session()->destroySession();
        $response = new Response();
        $response->redirectionBackoffice('index/login', 200);
    }

    /**
     * @param $params
     */
    public function profilAction()
    {
        $user = $this->getRequest()->session()->getCurrentUser();
        $form = new FormValidation($user, 'profil');

        if ($form->valid()){

            if ($form->getFile() != null) {
                if (($oldImage = $user->getImage()) != null){
                    $oldImage->delete(true);
                }
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($user->getEmail());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $user->setImage($image);
            }

            $user->save();
        }

        $view = new View('index', 'profil', 'backoffice');
        $view->assign("form", $form);
    }


}
