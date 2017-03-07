<?php

class User extends BaseSql{

  protected $id;
  protected $email;
  protected $pseudo;
  protected $password;
  protected $firstname;
  protected $lastname;
  protected $age;
  protected $status;
  protected $roles;
  protected $active;
  protected $created;
  protected $updated;

  public function __construct($condition = []) {
          parent::__construct($condition);
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getId() {
    return $this->id;
  }

  public function setEmail($email) {
    $this->email = trim($email);
  }

  public function setPseudo($pseudo) {
    $this->pseudo = trim($pseudo);
  }

  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  public function setLastname($lastname) {
    $this->lastname = trim($lastname);
  }

  public function setFirstname($firstname) {
    $this->firstname = trim($firstname);
  }

  public function setAge($age) {
    $this->age = $age;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function setRoles($roles) {
    $this->roles = $roles;
  }

  public function setActive($active) {
    $this->active = $active;
  }

  public function setCreated($created) {
    $this->created = $created;
  }

  public function setUpdated($updated) {
    $this->updated = $updated;
  }

}
