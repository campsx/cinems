<?php

class InstallerController{

	public function indexAction($params)
	{
		$view = new View('index', 'index');
	}

	public function step1Action($params)
	{
		$view = new View('installer', 'step1');
	}

    public function step2Action($params)
    {
        $view = new View('installer', 'step2');
    }

    public function step3Action($params)
    {
        $view = new View('installer', 'step3');
    }
}
