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



    private function listOfPagination($tableName, $page, $criteria = [], $where = '')
    {
        $className = ucfirst($tableName);

        $sql = "SELECT a.id FROM ".$tableName." as a ".(empty($where) ? '' : 'WHERE '.$where)." LIMIT 10 OFFSET ".($page * 10 - 10);
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


    public function listOfPaginationActive($tableName, $page, $criteria = [])
    {
        return $this->listOfPagination($tableName, $page, $criteria, 'active = 1');
    }

    public function listOfPaginationImage($page, $criteria = [])
    {
        return $this->listOfPagination('image', $page, $criteria, 'media = 1');
    }

    public function listOfPaginationAll($tableName, $page, $criteria = [])
    {
        return $this->listOfPagination($tableName, $page, $criteria);
    }

    public function countAll($tableName, $criteria = [])
    {
        $sql = "SELECT COUNT(*) FROM ".$tableName;
    }


}