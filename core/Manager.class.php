<?php

class Manager{

    protected $db;

    protected $request;

    protected $totalResult;

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
     * @return bool|string
     * Check good connexion
     */
    static function testConnexion()
    {
        $dns = DB_TYPE .
            ':host=' . DB_HOST .
            ';port=' . DB_PORT .
            ';dbname=' . DB_NAME;

        try {
            $pdo = new PDO($dns, DB_USER, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;
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
        $this->countAll($tableName, $criteria, $where);
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


    public function listOfPaginationActive($tableName, $page = 1, $criteria = [])
    {
        return $this->listOfPagination($tableName, $page, $criteria, 'active = 1');
    }

    public function listOfPaginationImage($page = 1, $criteria = [])
    {
        return $this->listOfPagination('image', $page, $criteria, 'media = 1');
    }

    public function listOfPaginationAll($tableName, $page = 1, $criteria = [])
    {
        return $this->listOfPagination($tableName, $page, $criteria);
    }

    public function countAll($tableName, $criteria = [], $where = '')
    {
        $sql = "SELECT COUNT(*) as nb FROM ".$tableName." as a ".(empty($where) ? '' : 'WHERE '.$where);
        $req = $this->db->prepare($sql);
        $req->execute();
        $this->totalResult = (int) $req->fetchAll(PDO::FETCH_ASSOC)[0]['nb'];
    }

    public function getTotalResult()
    {
        return $this->totalResult;
    }


    public function entityList($entityName, $display, $data = [])
    {
        $sql = "SELECT a.id, a.".$display." FROM ".$entityName." as a WHERE a.active = 1";
        $req = $this->db->prepare($sql);
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        foreach ($results as $result) {
            $list[] = [
                'id' => $result['id'],
                'label' => $result[$display],
                'active' => $this->inArrayEntity($data, $result['id'])
                ];
        }
        return $list;
    }

    /**
     * @param $data array || entity
     * @param $id int
     * @return boolean
     */
    public function inArrayEntity($data, $id)
    {
        if ($data == null){
            return false;
        } else if( is_array($data) ) {
            foreach($data as $entity){
                if ($entity->getId() == $id){
                    return true;
                }
            }
        } else {
            if ($data->getId() == $id){
                return true;
            }
        }
        return false;
    }

    public function commentAverage($id){
        $sql = "SELECT Avg(c.note) as note FROM film as f INNER JOIN comment as c ON f.id = c.film_id  WHERE c.active = 1 AND f.id =".$id;
        $req = $this->db->prepare($sql);
        $req->execute();
        $average = $req->fetchAll(PDO::FETCH_ASSOC);
        return $average[0]['note'];
    }


    /* list */

    public function topActors($nb = 5){
        $sql = "SELECT a.id FROM actor as a WHERE a.active = 1  LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Actor([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function topFilms($nb = 5){
        $sql = "SELECT a.id FROM film as a WHERE a.active = 1  LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Film([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function lastFilms($nb = 5){
        $sql = "SELECT a.id FROM film as a WHERE a.active = 1 ORDER BY a.created DESC LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Film([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function lastActors($nb = 5){
        $sql = "SELECT a.id FROM actor as a WHERE a.active = 1 ORDER BY a.created DESC LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Actor([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function lastDirectors($nb = 5){
        $sql = "SELECT a.id FROM director as a WHERE a.active = 1 ORDER BY a.created DESC LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Director([ "id" => $id['id']]);
            }
        }
        return $list;
    }

    public function pageList($nb = 5){
        $sql = "SELECT a.id FROM page as a WHERE a.active = 1 ORDER BY a.created DESC LIMIT ".$nb." OFFSET 0";
        $req = $this->db->prepare($sql);
        $req->execute();
        $allId = $req->fetchAll(PDO::FETCH_ASSOC);
        $list = [];
        if ($allId){
            foreach ($allId as $id) {
                $list[] = new Page([ "id" => $id['id']]);
            }
        }
        return $list;
    }

}