<?php

class IndexController{

	public function indexAction($params)
	{
	    //$usertest = new User(["id" => "camille"]);
	    /*$comment = new Comment();
	    $comment->setActive(0);
        $comment->setContent("content");
        $comment->setFilm(1);
        $comment->setNote(5);
        $comment->setTitle("test");
        $comment->setValid(1);
        $comment->setUser(1);*/
	   /* $comment = new Comment(['id' => 4]);

        $usertest->removeComment($comment);
        $usertest->save();*/

	    $film = new Film(["id" => 1]);
        $film->addActor(1);
        $film->save();
	    exit;
		$view = new View('index', 'index');
		$view->assign("form", $user->getForm());
	}

	public function page404Action($params)
	{
		$view = new View('errors', 'page404');
	}

}
