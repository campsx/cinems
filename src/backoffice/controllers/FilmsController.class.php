<?php

class FilmsController extends AbstractController {

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('films/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('film', empty($params[0]) ? 1 : $params[0]);
        $view = new View('films', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $film = new Film();
        $form = new formValidation($film, 'add');

        if ($form->valid()){

            if ($form->getFile() != null) {
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($film->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $film->setImage($image);
            }

            $film->setUser($this->getRequest()->session()->getCurrentUser());
            $film->save();

            $response = new Response();
            $response->redirectionBackoffice('films/list', 200);
        }

        $manager = new Manager();

        $form->addSelectList('director', $manager->entityList('director','firstname', $film->getDirector()));
        $form->addSelectList('actors', $manager->entityList('actor','firstname', $film->getActors()));
        $form->addSelectList('categories', $manager->entityList('category','title', $film->getCategories()));


        $view = new View('films', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('films/list', 200);
        }

        $film = new Film(['id' => $params[0]]);
        $form = new formValidation($film, 'edit');

        if ($form->valid()){

            if ($form->getFile() != null) {
                if (($oldImage = $film->getImage()) != null){
                    $oldImage->delete(true);
                }
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($film->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $film->setImage($image);
            }

            $film->save();

        }

        $manager = new Manager();

        $form->addSelectList('director', $manager->entityList('director','firstname', $film->getDirector()));
        $form->addSelectList('actors', $manager->entityList('actor','firstname', $film->getActors()));
        $form->addSelectList('categories', $manager->entityList('category','title', $film->getCategories()));


        $view = new View('films', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('films/list', 200);
        }

        $film = new Film(['id' => $params[0]]);
        $film->delete();

        $response = new Response();
        $response->redirectionBackoffice('films/list', 200);

    }

}
