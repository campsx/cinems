<?php

class Session{

    const ROLE_ADMIN = 'admin';
    const ROLE_USER =  'user';

    protected $currentUser = null;

    protected $allTokens = [];

    function __construct()
    {
        if (!empty($_SESSION['user_id'])){
            $this->currentUser = new User(['id' => $_SESSION['user_id']]);
        }


        foreach ($_SESSION as $key => $value) {
            if(preg_match('/^token_/', $key) == 1){
                $this->allTokens[$key] = $value;
            }
        }

    }

    /**
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }


    /**
     * @return mixed
     */
    public function getSession($key)
    {
        return $_SESSION[$key];
    }

    /**
     * @return mixed
     */
    public function addSession($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    /**
     * @return mixed
     */
    public function removeSession($key)
    {
        return $_SESSION;
    }

    public function isRole($role)
    {
        if ($this->currentUser == null) {
            return false;
        }

        foreach ($this->currentUser->getRoles() as $isRole) {
            if ($isRole === $role){
                return true;
            }
        }

        return false;
    }

    public function getAllToken(){
        return $this->allTokens;
    }

    public function getToken($name){
        return $this->allTokens['token_'.$name];
    }

    public function generateToken($name){
        return $_SESSION['token_'.$name] = $this->allTokens['token_'.$name] = sha1(uniqid());
    }

    public function destroySession(){
        session_unset();
        session_destroy();
    }

}