<?php

class InstallerService{

    protected $db;

    function __construct()
    {
        $this->db = new MyPDO();
    }

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

    static function testConnexionSQL($data = [])
    {

        $dsn = (isset($data['type']) ? $data['type'] : DB_TYPE ) .
            ':host=' . (isset($data['host']) ? $data['host'] : DB_HOST );

        try{
            $pdo = new PDO($dsn, (isset($data['user']) ? $data['user'] : DB_USER ), (isset($data['PWD']) ? $data['PWD'] : DB_PWD ));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
           return $e->getMessage();
        }

        return true;
    }

    static function installSQL($data = [], $withData = true)
    {
        $dsn = (isset($data['type']) ? $data['type'] : DB_TYPE ) .
        ':host=' . (isset($data['host']) ? $data['host'] : DB_HOST );

        try {
            $pdo = new PDO($dsn, (isset($data['user']) ? $data['user'] : DB_USER ), (isset($data['PWD']) ? $data['PWD'] : DB_PWD ));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            return $e->getMessage();
        }

        if ($withData){
            try{
                $sql = str_replace('databasenamehere', 'cinetest', file_get_contents(INSTALLER_FILE . "/full.sql"));
                $pdo->exec($sql);
            } catch(PDOException $e){
                return $e->getMessage();
            }

            self::imageInstall();
        } else {
            try{
                $sql = str_replace('databasenamehere', 'cinetest', file_get_contents(INSTALLER_FILE . "/no_full.sql"));
                $pdo->exec($sql);
            } catch(PDOException $e){
                return $e->getMessage();
            }
        }

        return true;
    }


    static function imageInstall()
    {
        
    }


}