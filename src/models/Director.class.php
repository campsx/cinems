<?php
class Director extends BaseSql{

  /**
   * @var Int
   */
  protected $id;

  /**
   * @var String
   */
  protected $firstname;

  /**
   * @var String
   */
  protected $lastname;

  /**
   * @var String
   */
  protected $age;

  /**
   * @var String
   */
  protected $slug;

  /**
   * @var String
   */
  protected $short_description;

  /**
   * @var DateTime
   */
  protected $description;

  /**
   * @var Boolean
   */
  protected $photo_id;

  /**
   * @var Json
   */
  protected $active;

  /**
   * @var Boolean
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


  public function setSlug($slug) {
    $this->slug = $slug;
  }

  /**
   * @return $slug varchar
   */
  public function getSlug() {
    return $this->slug;
  }


  public function setShortDescription($short_description) {
    $this->short_description = $short_description;
  }

  /**
   * @return $age DateTime
   */
  public function getShortDescription() {
    return $this->short_description;
  }


  public function setDescription($short_description) {
    $this->description = $short_description;
  }

  /**
   * @return $age DateTime
   */
  public function getDescription() {
    return $this->description;
  }


  public function setPhoto_id($photo_id) {
    $this->photo_id = $photo_id;
  }

  /**
   * @return $age DateTime
   */
  public function getPhoto_id() {
    return $this->photo_id;
  }


  public function setActive($active) {
    $this->active = $active;
  }

  /**
   * @return $age DateTime
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

}


?>
