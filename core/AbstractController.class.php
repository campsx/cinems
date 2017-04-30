<?php
abstract class AbstractController {


	public function getRequest(){
	    return Request::getInstance();
    }


}
