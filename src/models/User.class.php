<?php

class User extends BaseSql{

  protected $id;
  protected $email;
  protected $lastname;
  protected $firstname;
  protected $pwd;
  protected $status;
  protected $permission;

  public function __construct($id = -1, $email = null, $lastname = null,
        $firstname = null, $pwd = null, $status = 0, $permission = 0) {



          $this->setId($id);
          $this->setEmail($email);
          $this->setLastname($lastname);
          $this->setFirstname($firstname);
          $this->setPwd($pwd);
          $this->setStatus($status);
          $this->setPermission($permission);

          parent::__construct();
        }
  public function setId($id) {
    $this->id = $id;
  }

  public function setEmail($email) {
    $this->email = trim($email);
  }

  public function setLastname($lastname) {
    $this->lastname = trim($lastname);
  }

  public function setFirstname($firstname) {
    $this->firstname = trim($firstname);
  }

  public function setPwd($pwd) {
    $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function setPermission($permission) {
    $this->permission = $permission;
  }

}
