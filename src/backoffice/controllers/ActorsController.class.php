<?php

class ActorsController extends AbstractController {

	public function indexAction($params)
	{
	    $response = new Response();
	    $response->redirectionBackoffice('actors/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPagination('actor', 1);
		$view = new View('actors', 'list', 'backoffice');
		$view->assign('list', $list);
	}

	public function createAction($params)
	{
        $actor = new Actor();
        $form = new formValidation($actor, 'add');

        if ($form->valid()){

            $actor->save();

            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }

		$view = new View('actors', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{

		$view = new View('actors', 'edit', 'backoffice');
	}

	// @Todo: remove par requete sur list ou sa propre url avec redirection ??

}
