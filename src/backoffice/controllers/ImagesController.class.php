<?php
class ImagesController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'images/list');
		exit();
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationImage(1);
        $view = new View('images', 'list', 'backoffice');
        $view->assign('list', $list);
	}

	public function createAction($params)
	{

        $image = new Image();
        $form = new formValidation($image, 'add');

        if ($form->valid()){

            $image->setName($form->getFile()['name']);
            $image->setUrl($form->getFile()['urlName']);
            $image->tmp = $form->getFile()['tmp_name'];
            $image->save();

            $response = new Response();
            $response->redirectionBackoffice('images/list', 200);
        }


		$view = new View('images', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{

	}

	public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('images/list', 200);
        }

        $image = new Image(['id' => $params[0]]);
        $image->delete(true);

        $response = new Response();
        $response->redirectionBackoffice('images/list', 200);
    }


}
