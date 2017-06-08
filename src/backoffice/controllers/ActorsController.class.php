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
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('actors/list', 200);
        }


        $actor = new Actor(['id' => $params[0]]);
        $form = new formValidation($actor, 'edit');

        if ($form->valid()){
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
