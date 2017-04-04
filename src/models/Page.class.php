<?php
class Page extends BaseSql{

  /**
   * @var Int
   */
  protected $id;


  protected $title;


  protected $content;


  protected $thumbnail_id;


  protected $winter_id;


  protected $slug;

  /**
   * @var String
   */
  protected $short_description;




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

  public function getTitle() {
    return $this->title;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getContent() {
    return $content->content;
  }

  public function setContent($content) {
    $this->content = $content;
  }

  public function getThumbnailId() {
    return $thumbnail_id->thumbnail_id;
  }

  public function setThumbnailId($thumbnail_id) {
    $this->thumbnail_id = $thumbnail_id;
  }

  public function getWinterId() {
    return $winter_id->winter_id;
  }

  public function setWinterId($winter_id) {
    $this->winter_id = $winter_id;
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
