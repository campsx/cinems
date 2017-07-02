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
  protected $writer_note;

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
   * @var array Comment
   */
  protected $comments;

  /*
   * @var array Actors
   */
  protected $actors = [];

  /*
   * @var array Actors
   */
  protected $categories = [];

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

  public function setSlug($slug) {
    $this->slug = $slug;
  }

  /**
   * @return $slug varchar
   */
  public function getSlug() {
    return $this->slug;
  }

    /**
     * @param $short_description
     */
  public function setShortDescription($short_description) {
    $this->short_description = $short_description;
  }

  /**
   * @return $short_description String
   */
  public function getShortDescription() {
    return $this->short_description;
  }


  public function setContent($content) {
    $this->content = $content;
  }

  /**
   * @return $content String
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * @param $winter_note
   */
  public function setWriterNote($writer_note) {
      $this->writer_note = $writer_note;
  }

  /**
   * @return $content String
   */
  public function getWriterNote() {
      return $this->writer_note;
  }

  /**
   * @param $release_date
   */
  public function setReleaseDate($release_date) {
      $this->release_date = $release_date;
  }

  /**
   * @return $release_date DateTime
   */
  public function getReleaseDate() {
      return new DateTime($this->release_date);
  }

    /**
     * @param $image_id Image
     */
    public function setImage($image_id)
    {
        $this->setJoin('image_id', $image_id);
    }

    /**
     * @return $image_id Image
     */
    public function getImage()
    {
        return $this->getJoin('image_id');
    }

    /**
     * @param $user_id User
     */
    public function setUser($user_id)
    {
        $this->setJoin('user_id', $user_id);
    }

    /**
     * @return $photo_id Image
     */
    public function getUser()
    {
        return $this->getJoin('user_id');
    }

    /**
     * @param $director_id Director
     */
    public function setDirector($director_id)
    {
        $this->setJoin('director_id', $director_id);
    }

    /**
     * @return $director_id Director
     */
    public function getDirector()
    {
        return $this->getJoin('director_id');
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

  /**
   * @return array
   */
  public function getCategories() {
      return $this->getJoin("categories");
  }

    /**
     * @param $category Category | int
     */
    public function addCategory($category) {
        $this->setJoin("categories",$category);
    }

    /**
     * @param $category Category | int
     */
    public function removeCategory($category) {
        $this->removeJoin("categories", $category);
    }

    /**
     * @return array
     */
    public function getComments() {
        return $this->getJoin("comments");
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


    public function addForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE_ADMIN."films/create",
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Jean",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "jean-dupont",
                    "label" => "slug",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                        "slug",
                        "unique"
                    ]
                ],
                "image" => [
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                    "label" => "Images",
                    "required" => false
                ],
                "shortDescription" => [
                    "type" => "textarea",
                    "label" => "Short description",
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 200
                        ]
                    ]
                ],
                "content" => [
                    "type" => "textarea",
                    "label" => "Description",
                    "required" => false,
                    "wysiwyg" => true
                ],
                "writerNote" => [
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
                "releaseDate" => [
                    "type" => "date",
                    "placeholder" => "1990-12-14",
                    "label" => "Date de sortie",
                    "required" => true
                ],
                "director" => [
                    "type" => "entity",
                    "label" => "Director",
                    "required" => true,
                    "multiple" => false,
                    "entityName" => "director"
                ],
                "actors" => [
                    "type" => "entity",
                    "label" => "Actors",
                    "required" => true,
                    "multiple" => true,
                    "entityName" => "actor"
                ],
                "categories" => [
                    "type" => "entity",
                    "label" => "Categories",
                    "required" => true,
                    "multiple" => true,
                    "entityName" => "category"
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
                "action" => URL_WEBSITE_ADMIN."films/edit/".$this->id,
                "class" => "form-group",
                "submit" => "Modifier",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Jean",
                    "label" => "Title",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ],
                "slug" => [
                    "type" => "text",
                    "placeholder" => "jean-dupont",
                    "label" => "slug",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                        "slug",
                        "unique"
                    ]
                ],
                "image" => [
                    "type" => "file",
                    "placeholder" => "Ajouter une image",
                    "label" => "Images",
                    "required" => false
                ],
                "shortDescription" => [
                    "type" => "textarea",
                    "label" => "Short description",
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 200
                        ]
                    ]
                ],
                "content" => [
                    "type" => "textarea",
                    "label" => "Description",
                    "required" => false,
                    "wysiwyg" => true
                ],
                "writerNote" => [
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
                "releaseDate" => [
                    "type" => "date",
                    "placeholder" => "1990-12-14",
                    "label" => "Date de sortie",
                    "required" => true
                ],
                "director" => [
                    "type" => "entity",
                    "label" => "Director",
                    "required" => true,
                    "multiple" => false,
                    "entityName" => "director"
                ],
                "actors" => [
                    "type" => "entity",
                    "label" => "Actors",
                    "required" => true,
                    "multiple" => true,
                    "entityName" => "actor"
                ],
                "categories" => [
                    "type" => "entity",
                    "label" => "Categories",
                    "required" => true,
                    "multiple" => true,
                    "entityName" => "category"
                ]

            ]
        ];
    }



}
