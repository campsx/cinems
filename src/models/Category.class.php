<?php
class Category extends BaseSql{

  /**
   * @var Int
   */
  protected $id;


  protected $title;



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
