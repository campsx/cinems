<?php

class Image extends BaseSql{

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
  protected $name;

  /**
   * @var String
   */
  protected $url;

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
    $this->firstname = trim($title);
  }

  /**
   * @return $title String
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param $name String
   */
  public function setName($name) {
    $this->name = trim($name);
  }

  /**
   * @return $name String
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param $url string
   */
  public function setUrl($url) {
    $this->url = $url;
  }

  /**
   * @return $url string
   */
  public function getUrl() {
    return $this->url;
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
