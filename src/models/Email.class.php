<?php
class Email extends BaseSql{

  /**
   * @var Int
   */
  protected $id;



  protected $send;


  protected $content;


  protected $user_id;


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



   public function getSend() {
     return $send->send;
   }


   public function setSend($send) {
     $this->send = $send;
   }



   public function getContent() {
     return $this->content;
   }


   public function setContent($content) {
     $this->content = $content;
   }


   public function getUserID() {
     return $this->user_id;
   }


   public function setUserID($user_id) {
     $this->user_id = $user_id;
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


}

?>
