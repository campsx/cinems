<?php

class DirectorsController {

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('directors/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('director', empty($params[0]) ? 1 : $params[0]);
        $view = new View('directors', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $director = new Director();
        $form = new FormValidation($director, 'add');

        if ($form->valid()){

            if ($form->getFile() != null) {
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($director->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $director->setImage($image);
            }

            $director->save();

            $response = new Response();
            $response->redirectionBackoffice('directors/list', 200);
        }

        $view = new View('directors', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('directors/list', 200);
        }

        $director = new Director(['id' => $params[0]]);
        $form = new FormValidation($director, 'edit');

        if ($form->valid()){

            if ($form->getFile() != null) {
                if (($oldImage = $director->getImage()) != null){
                    $oldImage->delete(true);
                }
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($director->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $director->setImage($image);
            }

            $director->save();
        }

        $view = new View('directors', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('directors/list', 200);
        }

        $director = new Director(['id' => $params[0]]);
        $director->delete();

        $response = new Response();
        $response->redirectionBackoffice('directors/list', 200);

    }

}
