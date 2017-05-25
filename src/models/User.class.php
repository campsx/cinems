<?php

class User extends BaseSql
{

    /**
     * @var Int
     */
    protected $id;

    /**
     * @var String
     */
    protected $email;

    /**
     * @var String
     */
    protected $pseudo;

    /**
     * @var String
     */
    protected $password;

    /**
     * @var String
     */
    protected $firstname;

    /**
     * @var String
     */
    protected $lastname;

    /**
     * @var DateTime
     */
    protected $age;

    /**
     * @var Boolean
     */
    protected $status;

    /**
     * @var Image
     */
    protected $image_id;

    /**
     * @var Json
     */
    protected $roles;

    /**
     * @var Boolean
     */
    protected $active;

    /**
     * @var array Comment
     */
    protected $comments = [];

    /**
     * @var array Comment
     */
    protected $emails = [];

    /**
     * @var array Comment
     */
    protected $films = [];

    /**
     * @var String
     */
    protected $token_email;

    /**
     * @var String
     */
    protected $token_password;

    /**
     * @var DateTime
     */
    protected $token_expiration;

    /**
     * @var DateTime
     */
    protected $created;

    /**
     * @var DateTime
     */
    protected $updated;

    /**
     * @param $condition array
     */
    public function __construct($condition = [])
    {
        $this->joinProperties['OneToMany'] = [
            'comments' => [
                'table' => 'comment'
            ],
            'emails' => [
                'table' => 'email'
            ],
            'films' => [
                'table' => 'film'
            ]
        ];
        $this->joinProperties['ManyToOne'] = [
            'image_id' => [
                'table' => 'image'
            ]
        ];

        parent::__construct($condition);
    }

    /**
     * @param $id Int
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return $id Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $email String
     */
    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    /**
     * @return $email String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $pseudo String
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = trim($pseudo);
    }

    /**
     * @return $pseudo String
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param $password String
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return $password String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $lastname String
     */
    public function setLastname($lastname)
    {
        $this->lastname = trim($lastname);
    }

    /**
     * @return $lastname String
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param $firstname String
     */
    public function setFirstname($firstname)
    {
        $this->firstname = trim($firstname);
    }

    /**
     * @return $firstname String
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param $age DateTime
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return $age DateTime
     */
    public function getAge()
    {
        return new DateTime($this->age);
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
     * @param $status Boolean
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return $status Boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $roles Json
     */
    public function setRoles($roles)
    {
        $this->roles = json_encode($roles);
    }

    /**
     * @return $roles Json
     */
    public function getRoles()
    {
        return json_decode($this->roles);
    }

    /**
     * @param $active Boolean
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return $active Boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param String
     */
    public function setTokenEmail($token)
    {
        $this->token_email = $token;
    }

    /**
     * @return String
     */
    public function getTokenEmail()
    {
        return $this->token_email;
    }

    /**
     * @param String
     */
    public function setTokenPassword($token)
    {
        $this->token_password = $token;
    }

    /**
     * @return String
     */
    public function getTokenPassword()
    {
        return $this->token_password;
    }

    /**
     * @param Datetime
     */
    public function setTokenExpiration($date)
    {
        $this->token_expiration = $date;
    }

    /**
     * @return Datetime
     */
    public function getTokenExpiration()
    {
        return new DateTime($this->token_expiration);
    }

    /**
     * @param $created DateTime
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return $created DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param $updated DateTime
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return $updated DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param $comment Comment | int
     */
    public function addComment($comment)
    {
        $this->setJoin("comments", $comment);
    }

    /**
     * @param $comment Comment | int
     */
    public function removeComment($comment)
    {
        $this->removeJoin("comments", $comment);
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->getJoin("comments");
    }

    /**
     * @param $email Email | int
     */
    public function addEmail($email)
    {
        $this->setJoin("emails", $email);
    }

    /**
     * @param $email Email | int
     */
    public function removeEmail($email)
    {
        $this->removeJoin("emails", $email);
    }

    /**
     * @return array
     */
    public function getEmails()
    {
        return $this->getJoin("emails");
    }

    /**
     * @param $film Film | int
     */
    public function addFilm($film)
    {
        $this->setJoin("films", $film);
    }

    /**
     * @param $film Film | int
     */
    public function removeFilm($film)
    {
        $this->removeJoin("films", $film);
    }

    /**
     * @return array
     */
    public function getFilms()
    {
        return $this->getJoin("films");
    }

    public function inscriptionForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE."user/inscription",
                "class" => "form-group",
                "submit" => "S'inscrire",
                "capcha" => true
            ],
            "data" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "test@gmail.com",
                    "label" => "Votre email",
                    "required" => true,
                    "validation" => [
                        "length" => [
                            "min" => 10,
                            "max" => 255
                        ],
                        "unique" => true
                    ]
                ],
                "pseudo" => [
                    "type" => "text",
                    "placeholder" => "jojodu77",
                    "label" => "Votre Pseudo",
                    "required" => true,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                        "unique"
                    ]
                ],
                "password" => [
                    "type"        => "password",
                    "placeholder" => "********",
                    "label"       => "Votre Password",
                    "required"    => true,
                    "validation"  => [
                        "length" => [
                            "min" => 8,
                            "max" => 255
                        ]
                    ]
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Jean",
                    "label" => "Votre nom",
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
                    "label" => "Votre Prenom",
                    "required" => false,
                    "validation"  => [
                        "length" => [
                            "min" => 2,
                            "max" => 100
                        ],
                    ]
                ],
                "age" => [
                    "type" => "date",
                    "placeholder" => "1990-12-14",
                    "label" => "Votre age",
                    "required" => false,
                    "validation"  => [
                        "interval" => [
                            "min" => 10,
                            "max" => 100
                        ],
                    ]
                ]
            ],
            "initData" => [
                "status" => 0,
                "roles" => ["user"],
                "active" => 1
            ]
        ];
    }

    public function changePasswordForm()
    {
        return [
            "struct" => [
                "method" => "POST",
                "action" => URL_WEBSITE."user/changepass/".$this->getTokenPassword(),
                "class" => "form-group",
                "submit" => "Changer"
            ],
            "data" => [
                "password" => [
                    "type"        => "password",
                    "placeholder" => "********",
                    "label"       => "Votre nouveau Password",
                    "required"    => true,
                    "validation"  => [
                        "length" => [
                            "min" => 8,
                            "max" => 255
                        ]
                    ]
                ]
            ]
        ];
    }

}
