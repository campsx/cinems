<?php
class UsersController{


	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('users/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('user', empty($params[0]) ? 1 : $params[0]);
        $view = new View('users', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $user = new User();
        $form = new formValidation($user, 'add');

        if ($form->valid()){

            if ($form->getFile() != null) {
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

            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }

        $view = new View('users', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }


        $user = new User(['id' => $params[0]]);
        $form = new formValidation($user, 'edit');

        if ($form->valid()){

            if ($form->getFile() != null) {
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

        $view = new View('users', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('users/list', 200);
        }

        $user = new User(['id' => $params[0]]);
        $user->delete();

        $response = new Response();
        $response->redirectionBackoffice('users/list', 200);

    }


}
