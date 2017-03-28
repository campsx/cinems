<?php

class User extends BaseSql{

  /**
   * @var Int
   */
  protected $id;

  /**
   * @var String
   */
  protected $email;

  /**
   * @var String
   */
  protected $pseudo;

  /**
   * @var String
   */
  protected $password;

  /**
   * @var String
   */
  protected $firstname;

  /**
   * @var String
   */
  protected $lastname;

  /**
   * @var DateTime
   */
  protected $age;

  /**
   * @var Boolean
   */
  protected $status;

  /**
   * @var Json
   */
  protected $roles;

  /**
   * @var Boolean
   */
  protected $active;

  /**
   * @var DateTime
   */
  protected $created;

  /**
   * @var DateTime
   */
  protected $updated;

  /**
   * @param $condition Array
   */
  public function __construct($condition = []) {
          parent::__construct($condition);
  }

  /**
   * @param $id Int
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return $id Int
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param $email String
   */
  public function setEmail($email) {
    $this->email = trim($email);
  }

  /**
   * @return $email String
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param $pseudo String
   */
  public function setPseudo($pseudo) {
    $this->pseudo = trim($pseudo);
  }

  /**
   * @return $pseudo String
   */
  public function getPseudo() {
    return $this->pseudo;
  }

  /**
   * @param $password String
   */
  public function setPassword($password) {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }

  /**
   * @return $password String
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param $lastname String
   */
  public function setLastname($lastname) {
    $this->lastname = trim($lastname);
  }

  /**
   * @return $lastname String
   */
  public function getLastname() {
    return $this->lastname;
  }

  /**
   * @param $firstname String
   */
  public function setFirstname($firstname) {
    $this->firstname = trim($firstname);
  }

  /**
   * @return $firstname String
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * @param $age DateTime
   */
  public function setAge($age) {
    $this->age = $age;
  }

  /**
   * @return $age DateTime
   */
  public function getAge() {
    return $this->age;
  }

  /**
   * @param $status Boolean
   */
  public function setStatus($status) {
    $this->status = $status;
  }

  /**
   * @return $status Boolean
   */
  public function getStatus() {
    return $this->status;
  }

  /**
   * @param $roles Json
   */
  public function setRoles($roles) {
    $this->roles = $roles;
  }

  /**
   * @return $roles Json
   */
  public function getRoles() {
    return $this->roles;
  }

  /**
   * @param $active Boolean
   */
  public function setActive($active) {
    $this->active = $active;
  }

  /**
   * @return $active Boolean
   */
  public function getActive() {
    return $this->active;
  }

  /**
   * @param $created DateTime
   */
  public function setCreated($created) {
    $this->created = $created;
  }

  /**
   * @return $created DateTime
   */
  public function getCreated() {
    return $this->created;
  }

  /**
   * @param $updated DateTime
   */
  public function setUpdated($updated) {
    $this->updated = $updated;
  }

  /**
   * @return $updated DateTime
   */
  public function getUpdated() {
    return $this->updated;
  }

  public function getForm() {
    return [
        "struct" => [
            "method" => "POST",
            "action" => "user/add",
            "class"  => "form-group",
            "submit" => "S'inscrire",
        ],
        "data" => [
                "email" => [
                    "type"        => "email",
                    "placeholder" => "test@gmail.com",
                    "label"       => "Votre email",
                    "required"    => true
                ],
                "firstname" => [
                    "type"        => "text",
                    "placeholder" => "Jean",
                    "label"       => "Votre nom",
                    "required"    => false
                ]
        ]
    ];
  }

}
