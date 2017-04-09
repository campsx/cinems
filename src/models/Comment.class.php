<?php

class Comment extends BaseSql{

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
  protected $content;

  /**
   * @var String
   */
  protected $note;

  /**
   * @var String
   */
  protected $valid;

  /**
   * @var String
   */
  protected $active;

  /**
   * @var DateTime
   */
  protected $user_id;

  /**
   * @var Boolean
   */
  protected $film_id;

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
   * @return $id Int
   */
  public function getId() {
    return $this->id;
  }


  /**
   * @param $title String
   */
  public function setTitle($title) {
    $this->title = trim($title);
  }

  /**
   * @return $title String
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param $content String
   */
  public function setContent($content) {
    $this->content = trim($content);
  }

  /**
   * @return $content String
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * @param $note integer
   */
  public function setNote($note) {
    $this->note = $note;
  }

  /**
   * @return $note integer
   */
  public function getNote() {
    return $this->note;
  }


  public function setValid($valid) {
    $this->valid = $valid;
  }

  /**
   * @return $valid boolean
   */
  public function getValid() {
    return $this->valid;
  }


  public function setActive($active) {
    $this->active = $active;
  }

  /**
   * @return $active boolean
   */
  public function getActive() {
    return $this->active;
  }


  public function setUser($user_id) {
    $this->user_id = $user_id;
  }

  /**
   * @return $user_id User
   */
  public function getUser() {
    return $this->user_id;
  }


  public function setFilm($film_id) {
    $this->film_id = $film_id;
  }

  /**
   * @return $film_id Film
   */
  public function getFilm() {
    return $this->film_id;
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
