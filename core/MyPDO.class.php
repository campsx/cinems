<?php

class MyPDO extends PDO
{
    public function __construct()
    {
      $dns = DB_TYPE .
      ':host=' . DB_HOST .
      ';port=' . DB_PORT .
      ';dbname=' . DB_NAME;

      try {
          parent::__construct($dns, DB_USER, DB_PWD);
          if (ENV_IS_DEV) {
              $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
      } catch (Exception $e) {
          Errors::error500($e->getMessage());
      }
    }

}
