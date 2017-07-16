<?php

class ActorsController extends AbstractController {

	public function indexAction()
	{
	    $response = new Response();
	    $response->redirectionBackoffice('actors/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('actor', empty($params[0]) ? 1 : $params[0]);
		$view = new View('actors', 'list', 'backoffice');
		$view->assign('list', $list);
		$view->assign('nbPage', ceil($manager->getTotalResult() / 10));
		$view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction()
	{
        $actor = new Actor();
        $form = new FormValidation($actor, 'add');

        if ($form->valid()){

            if ($form->getFile() != null) {
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($actor->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $actor->setImage($image);
            }

            $actor->save();

            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }

		$view = new View('actors', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }


        $actor = new Actor(['id' => $params[0]]);
        $form = new FormValidation($actor, 'edit');

        if ($form->valid()){

            if ($form->getFile() != null) {
                if (($oldImage = $actor->getImage()) != null){
                    $oldImage->delete(true);
                }
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($actor->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $actor->setImage($image);
            }

            $actor->save();
        }

        $view = new View('actors', 'edit', 'backoffice');
        $view->assign("form", $form);
	}


    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }

        $actor = new Actor(['id' => $params[0]]);
        $actor->delete();

        $response = new Response();
        $response->redirectionBackoffice('actors/list', 200);

    }

}
