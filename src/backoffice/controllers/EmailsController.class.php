<?php
class EmailsController{


	public function indexAction($params)
	{
		header('Status: 301 Moved Permanently', false, 301);
		header('Location: '.URL_WEBSITE_ADMIN.'emails/list');
		exit();
	}

	public function listAction($params)
	{
        $manager = new Manager();
        $list = $manager->listOfPaginationAll('email', 1);
        $view = new View('emails', 'list', 'backoffice');
        $view->assign('list', $list);

	}


	public function editAction($params)
	{
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionBackoffice('emails/list', 200);
        }

        $email = new Email(['id' => $params[0]]);
        $form = new formValidation($email, 'edit');

        if ($form->valid()){
            $email->save();
        }

        $view = new View('emails', 'edit', 'backoffice');
        $view->assign("form", $form);
	}


}
