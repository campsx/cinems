<?php
class FilmController extends AbstractController {


    public function indexAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }


        $response = new Response();
        $response->redirectionFrontend('film/view/'.$params[0], 301);
    }


    public function viewAction($params)
    {
        if (empty($params[0])) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $film = new Film(['slug' => $params[0]]);
        $comment = new Comment();

        $form = new FormValidation($comment, 'add');

        if ($form->valid()){

            $comment->setFilm($film);
            $comment->setUser($this->getRequest()->session()->getCurrentUser());
            $comment->save();

        }

        if ($film->getId() === null) {
            $response = new Response();
            $response->redirectionFrontend('index/page404', 404);
        }

        $view = new View('films', 'index');
        $view->assign("film", $film);
        $view->assign('token', $form->generateNewToken());
        $view->assign('errors', $form->getErrors());
    }


}
