<?php
class DirectorController{


	public function indexAction($param)
	{
		$director = new Director(['id'=>1]);
      $view = new View('directors', 'index');
			$view->assign("director",$director);
	}


}
