<?php
class Director extends BaseSql{

  /**
   * @var Int
   */
  protected $id;

  /**
   * @var String
   */
  protected $firstname;

  /**
   * @var String
   */
  protected $lastname;

  /**
   * @var String
   */
  protected $age;

  /**
   * @var String
   */
  protected $slug;

  /**
   * @var String
   */
  protected $short_description;

  /**
   * @var DateTime
   */
  protected $description;

  /**
   * @var Boolean
   */
  protected $photo_id;

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
      $this->joinProperties['ManyToOne'] = [
          'photo_id' => [
              'table' => 'image'
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
   * @param $firstname String
   */
  public function setFirstname($firstname) {
    $this->firstname = trim($firstname);
  }

  /**
   * @return $firstname String
   */
  public function getFirstname() {
    return $this->firstname;
  }

  /**
   * @param $lastname String
   */
  public function setLastname($lastname) {
    $this->lastname = trim($lastname);
  }

  /**
   * @return $lastname String
   */
  public function getLastname() {
    return $this->lastname;
  }

  /**
   * @param $age DateTime
   */
  public function setAge($age) {
    $this->age = $age;
  }

  /**
   * @return $age DateTime
   */
  public function getAge() {
    return $this->age;
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


  public function setDescription($short_description) {
    $this->description = $short_description;
  }

  /**
   * @return $age DateTime
   */
  public function getDescription() {
    return $this->description;
  }


  public function setImage($photo_id) {
      $this->setJoin('photo_id', $photo_id);
  }

  /**
   * @return $age DateTime
   */
  public function getImage() {
    return $this->getJoin('photo_id');
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
                "action" => URL_WEBSITE_ADMIN."directors/create",
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Jean",
                    "label" => "Nom",
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Dupont",
                    "label" => "Prenom",
                    "required" => false,
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
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                        "slug",
                        "unique"
                    ]
                ],
                "age" => [
                    "type" => "date",
                    "placeholder" => "1990-12-14",
                    "label" => "Age",
                    "required" => false
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
                "description" => [
                    "type" => "textarea",
                    "label" => "Description",
                    "required" => false,
                    "wysiwyg" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 200
                        ]
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
                "action" => URL_WEBSITE_ADMIN."directors/edit/".$this->getId(),
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Jean",
                    "label" => "Nom",
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],

                    ]
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Dupont",
                    "label" => "Prenom",
                    "required" => false,
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
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                        "slug",
                        "unique"
                    ]
                ],
                "age" => [
                    "type" => "date",
                    "placeholder" => "1990-12-14",
                    "label" => "Age",
                    "required" => false
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
                "description" => [
                    "type" => "textarea",
                    "label" => "Description",
                    "required" => false,
                    "wysiwyg" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 200
                        ]
                    ]
                ]
            ]
        ];
    }

}
