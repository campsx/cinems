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
   * @var boolean
   */
  protected $media;

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
   * @param bool
   */
  public function setMedia($media)
  {
      $this->media = $media;
  }

  /**
   * @return bool
   */
  public function getMedia()
  {
      return $this->media;
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


  public function removeCallback()
  {
      if(file_exists(DIR_UPLOAD.$this->url)){
          unlink(DIR_UPLOAD.$this->url);
      }
  }

  public function createCallback()
  {
      if(!file_exists(DIR_UPLOAD)){
          mkdir(DIR_UPLOAD, 0700);
      }

      move_uploaded_file($this->tmp, DIR_UPLOAD . $this->url);
  }


    public function addForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE_ADMIN."images/create",
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "image" => [
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                    "label" => "Images",
                    "required" => false
                ],
                "title" => [
                    "type" => "text",
                    "placeholder" => "image de plage",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ]
                    ]
                ]
            ],
            "initData" => [
                "media" => 1
            ]
        ];
    }

}
