<?php

class Session{

    public static $ROLE_ADMIN = 'admin';
    public static $ROLE_USER =  'user';

    protected $currentUser = null;

    protected $oldToken;

    protected $newToken;

    function __construct()
    {
        if (!empty($_SESSION['user_id'])){
            $this->currentUser = new User(['id' => $_SESSION['user_id']]);
        }

        if (!empty($_SESSION['token'])){
            $this->oldToken = $_SESSION['token'];
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

    public function getOldToken(){
        return $this->oldToken;
    }

    public function getToken(){
        return $this->newToken;
    }

    public function generateToken(){
        $_SESSION['token'] = $this->newToken = sha1(uniqid());
    }

    public function destroySession(){
        session_unset();
        session_destroy();
    }

}