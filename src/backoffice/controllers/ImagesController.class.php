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
        $list = $manager->listOfPaginationImage(empty($params[0]) ? 1 : $params[0]);
        $view = new View('images', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{

        $image = new Image();
        $form = new FormValidation($image, 'add');

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
