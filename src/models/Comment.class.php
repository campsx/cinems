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
   * @var User
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
      $this->joinProperties['ManyToOne'] = [
          'user_id' => [
              'table' => 'user'
          ],
          'film_id' => [
              'table' => 'film'
          ]
      ];
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
      $this->setJoin('user_id', $user_id);
  }

  /**
   * @return $user_id User
   */
  public function getUser() {
      return $this->getJoin('user_id');
  }


  public function setFilm($film_id) {
      $this->setJoin('film_id', $film_id);
  }

  /**
   * @return $film_id Film
   */
  public function getFilm() {
      return $this->getJoin('film_id');
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


    public function editForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE_ADMIN."comments/edit/".$this->id,
                "class" => "form-group",
                "submit" => "Modifier",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Super film",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ]
                    ]
                ],
                "content" => [
                    "type" => "textarea",
                    "label" => "Content",
                    "required" => false
                ],
                "note" => [
                    "type" => "number",
                    "placeholder" => "Exemple : 4",
                    "label" => "Note",
                    "required" => true,
                    "validation"  => [
                        "lengthNumber" => [
                            "min" => 1,
                            "max" => 5
                        ],
                    ]
                ],
                "valid" => [
                    "type" => "radioTrueFalse",
                    "label" => "Status",
                    "required" => true
                ]
            ]
        ];
    }

    public function addForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE."film/view/".$this->id,
                "class" => "form-group",
                "submit" => "Modifier",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Super film",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ]
                    ]
                ],
                "content" => [
                    "type" => "textarea",
                    "label" => "Content",
                    "required" => true
                ],
                "note" => [
                    "type" => "number",
                    "placeholder" => "Exemple : 4",
                    "label" => "Note",
                    "required" => true,
                    "validation"  => [
                        "lengthNumber" => [
                            "min" => 1,
                            "max" => 5
                        ],
                    ]
                ]
            ],
            "initData" => [
                "valid" => 0,
                "active" => 1
            ]
        ];
    }



}
