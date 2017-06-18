<?php

class CategoriesController{

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('categories/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('category', empty($params[0]) ? 1 : $params[0]);
        $view = new View('categories', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $category = new Category();
        $form = new formValidation($category, 'add');

        if ($form->valid()){

            $category->save();

            $response = new Response();
            $response->redirectionBackoffice('categories/list', 200);
        }

        $view = new View('categories', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('categories/list', 200);
        }

        $category = new Category(['id' => $params[0]]);
        $form = new formValidation($category, 'edit');

        if ($form->valid()){

            $category->save();

            $response = new Response();
            $response->redirectionBackoffice('categories/list', 200);
        }

        $view = new View('categories', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('categories/list', 200);
        }

        $category = new Category(['id' => $params[0]]);
        $category->delete();

        $response = new Response();
        $response->redirectionBackoffice('categories/list', 200);

    }

}
