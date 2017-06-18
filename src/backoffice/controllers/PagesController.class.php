<?php

class PagesController extends AbstractController {

	public function indexAction($params)
	{
        $response = new Response();
        $response->redirectionBackoffice('pages/list', 301);
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationActive('page', empty($params[0]) ? 1 : $params[0]);
        $view = new View('pages', 'list', 'backoffice');
        $view->assign('list', $list);
        $view->assign('nbPage', ceil($manager->getTotalResult() / 10));
        $view->assign('page', empty($params[0]) ? 1 : $params[0]);
	}

	public function createAction($params)
	{
        $page = new Page();
        $form = new formValidation($page, 'add');

        if ($form->valid()){

            if ($form->getFile() != null) {
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($page->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $page->setThumbnail($image);
            }

            $page->setWinter($this->getRequest()->session()->getCurrentUser());
            $page->save();

            $response = new Response();
            $response->redirectionBackoffice('pages/list', 200);
        }

        $view = new View('pages', 'create', 'backoffice');
        $view->assign("form", $form);
	}

	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('directors/list', 200);
        }

        $page = new Page(['id' => $params[0]]);
        $form = new formValidation($page, 'edit');

        if ($form->valid()){

            if ($form->getFile() != null) {
                $image = new Image();
                $image->setName($form->getFile()['name']);
                $image->setTitle($page->getSlug());
                $image->setUrl($form->getFile()['urlName']);
                $image->setMedia(0);
                $image->tmp = $form->getFile()['tmp_name'];
                $image->save();
                $page->setThumbnail($image);
            }

            $page->save();
        }

        $view = new View('pages', 'edit', 'backoffice');
        $view->assign("form", $form);
	}

    public function removeAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('pages/list', 200);
        }

        $page = new Page(['id' => $params[0]]);
        $page->delete();

        $response = new Response();
        $response->redirectionBackoffice('pages/list', 200);

    }

}
