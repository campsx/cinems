<?php

class Category extends BaseSql{

  /**
   * @var Int
   */
  protected $id;

  /**
   * @var String
   */
  protected $title;

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
   * @param $title
   */
  public function setTitle($title) {
      $this->title = $title;
  }

  /**
   * @return string
   */
  public function getTitle() {
     return $this->title;
  }

   /**
    * @param $active
    */
   public function setActive($active) {
     $this->active = $active;
   }

   /**
    * @return $active DateTime
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

    public function addForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE_ADMIN."categories/create",
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Horreur",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ]
            ],
            "initData" => [
                "active" => 1
            ]
        ];
    }

    public function editForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE_ADMIN."categories/edit/".$this->id,
                "class" => "form-group",
                "submit" => "Modifier",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Horreur",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ]
            ]
        ];
    }

}