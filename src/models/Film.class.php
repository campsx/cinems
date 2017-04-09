<?php

class Film extends BaseSql{

  /**
   * @var Int
   */
  protected $id;

  /**
   * @var String
   */
  protected $title;

  /**
   * @var String
   */
  protected $slug;

  /**
   * @var String
   */
  protected $short_description;

  /**
   * @var String
   */
  protected $content;

  /**
   * @var integer
   */
  protected $winter_note;

  /**
   * @var DateTime
   */
  protected $release_date;

  /**
   * @var Director
   */
  protected $director_id;

  /**
   * @var User
   */
  protected $user_id;

  /**
   * @var Image
   */
  protected $image_id;

  /**
   * @var integer
   */
  protected $active;

  /*
   * @var array Actors
   */
  protected $actors;

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
      $this->joinProperties['ManyToMany'] = [
          'actors' => [
              'table' => 'actor',
              'joinTable' => 'actor_has_film'
          ],
          'categories' => [
              'table' => 'category',
              'joinTable' => 'film_has_category'
          ],
      ];
      $this->joinProperties['OneToMany'] = [
          'comments' => [
              'table' => 'comment'
          ]
      ];
      $this->joinProperties['ManyToOne'] = [
          'image_id' => [
              'table' => 'image'
          ],
          'user_id' => [
              'table' => 'user'
          ],
          'director_id' => [
              'table' => 'director'
          ]
      ];
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

  /**
   * @param $actor Actor | int
   */
  public function addActor($actor) {
      $this->setJoin("actors",$actor);
  }

  /**
   * @param $actor Actor | int
   */
  public function removeActor($actor) {
      $this->removeJoin("actors", $actor);
  }

  /**
   * @return array
   */
  public function getActors() {
      return $this->getJoin("actors");
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
