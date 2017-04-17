<?php

class Request{

    /**
     * @var array
     */
    protected $getQuery = [];

    /**
     * @var array
     */
    protected $postQuery = [];

    /**
     * @var String
     */
    protected $requestType;

    /**
     * @var Session
     */
    protected $session;

    function __construct()
    {
        $this->session = new Session();
        $this->requestType = $_SERVER['REQUEST_METHOD'];

        $this->getQuery = $_GET;
        $this->postQuery = $_POST;

        // todo: check $_SERVER['HTTP_REFERER'] avec la session
        $this->session()->generateToken();
    }

    /**
     * @return array
     */
    public function getGETQuery()
    {
        return $this->getQuery;
    }

    /**
     * @return array
     */
    public function getPOSTQuery()
    {
        return $this->postQuery;
    }

    /**
     * @return String
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /**
     * @return Boolean
     */
    public function isPOSTRequest(){
        return $this->requestType === 'POST';
    }

    /**
     * @return Boolean
     */
    public function isGETRequest(){
        return $this->requestType === 'GET';
    }

    /**
     * @return Boolean
     */
    public function goodToken($token){
        return $this->session()->getOldToken() == $token;
    }


    /**
     * @return Session
     */
    public function session()
    {
        return $this->session;
    }

}