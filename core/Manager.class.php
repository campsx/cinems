<?php

class Manager{

    protected $db;

    protected $request;

    protected $errors = [];

    function __construct()
    {
        $this->db = new MyPDO();
        $this->request = Request::getInstance();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function addErrors($string, $data = [])
    {
        $this->errors[] = vsprintf($string, $data);
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
            $this->addErrors(Errors::LOGIN_ERROR);
            return false;
        }
        $this->request->session()->addSession('user_id', $user['id']);

        return true;
    }

    public function listOfPagination($tableName, $page, $criteria = [])
    {
        $className = ucfirst($tableName);

        $sql = "SELECT a.id FROM ".$tableName." as a LIMIT 10 OFFSET ".($page * 10 - 10);
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new $className([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function countAll($tableName, $criteria = [])
    {
        $sql = "SELECT COUNT(*) FROM ".$tableName;
    }


}