<?php
class Email extends BaseSql{

  /**
   * @var Int
   */
  protected $id;


  protected $send;

    /**
     * @var string
     */
  protected $subject;

    /**
     * @var string
     */
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

      $this->joinProperties['ManyToOne'] = [
          'user_id' => [
              'table' => 'user'
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



   public function getSend() {
     return $this->send;
   }


   public function setSend($send) {
     $this->send = $send;
   }

    /**
     * @return string
     */
   public function getSubject() {
       return $this->subject;
   }

   public function setSubject($subject) {
       $this->subject = $subject;
   }


   public function getContent() {
       return $this->content;
   }


   public function setContent($content, $data) {
       $this->content = vsprintf($content, $data);
   }


    /**
     * @return mixed
     */
   public function getUser() {
       return $this->getJoin('user_id');
   }

    /**
     * @param $user_id
     */
   public function setUser($user) {
       $this->setJoin('user_id', $user);
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