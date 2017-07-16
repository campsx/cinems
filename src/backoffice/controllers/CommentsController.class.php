<?php

class CommentsController{

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('comments/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('comment', empty($params[0]) ? 1 : $params[0]);
        $view = new View('comments', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $view = new View('comments', 'create', 'backoffice');
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('comments/list', 200);
        }

        $comment = new Comment(['id' => $params[0]]);
        $form = new FormValidation($comment, 'edit');

        if ($form->valid()){

            $comment->save();

            $response = new Response();
            $response->redirectionBackoffice('comments/edit', 200);
        }

        $view = new View('comments', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('comments/list', 200);
        }

        $user = new Comment(['id' => $params[0]]);
        $user->delete();

        $response = new Response();
        $response->redirectionBackoffice('comments/list', 200);

    }

}
