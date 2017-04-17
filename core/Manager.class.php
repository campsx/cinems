<?php

class Manager{

    protected $db;

    protected $request;

    function __construct($request)
    {
        $this->db = new MyPDO();
        $this->request = $request;
    }

    /**
     * @return boolean
     */
    public function checkConnection($login, $password)
    {
        $sql = "SELECT * FROM user as u WHERE u.email = :login ;";
        $req = $this->db->prepare($sql);
        $req->execute([
            'login' => $login
        ]);

        $user = $req->fetch(PDO::FETCH_ASSOC);
        if ($user === false || password_verify($password, $user['password']) === false){
            return false;
        }
        $this->request->session()->addSession('user_id', $user['id']);

        return true;
    }

}