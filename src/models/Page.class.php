<?php
class Page extends BaseSql{

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
     * @var Image
     */
    protected $thumbnail_id;

    /**
     * @var User
     */
    protected $winter_id;

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
        $this->joinProperties['ManyToOne'] = [
            'thumbnail_id' => [
                'table' => 'image'
            ],
            'winter_id' => [
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

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param $slug
     */
    public function setSlug($slug) {
        $this->slug = $slug;
    }

    /**
     * @return $slug String
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
     * @return String
     */
    public function getShortDescription() {
        return $this->short_description;
    }

    /**
     * @param $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return String
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param $thumbnail
     */
    public function setThumbnail($thumbnail) {
        $this->setJoin('thumbnail_id', $thumbnail);
    }

    /**
     * @return Image
     */
    public function getThumbnail() {
        return $this->getJoin('thumbnail_id');
    }

    /**
     * @param $winter
     */
    public function setWinter($winter) {
        $this->setJoin('winter_id', $winter);
    }

    /**
     * @return User
     */
    public function getWinter() {
        return $this->getJoin('winter_id');
    }

    /**
     * @param $active
     */
    public function setActive($active) {
        $this->active = $active;
    }

    /**
     * @return Boolean
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
                "action" => URL_WEBSITE_ADMIN."pages/create",
                "class" => "form-group",
                "submit" => "Créer",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Nous contacter",
                    "label" => "Title",
                    "required" => true,
                    "validation" => [
                        "length" => [
                            "min" => 2,
                            "max" => 255
                        ],
                        "unique"
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
                    "label" => "Content",
                    "required" => true,
                    "wysiwyg" => true
                ],
                "thumbnail" => [
                    "type" => "file",
                    "placeholder" => "Ajouter un thumbnail",
                    "label" => "Thumbnail",
                    "required" => false
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
                "action" => URL_WEBSITE_ADMIN."pages/edit/".$this->id,
                "class" => "form-group",
                "submit" => "Modifier",
                "enctype" => "multipart/form-data"
            ],
            "data" => [
                "title" => [
                    "type" => "text",
                    "placeholder" => "Nous contacter",
                    "label" => "Title",
                    "required" => true,
                    "validation" => [
                        "length" => [
                            "min" => 2,
                            "max" => 255
                        ],
                        "unique"
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
                    "label" => "Content",
                    "required" => true,
                    "wysiwyg" => true
                ],
                "thumbnail" => [
                    "type" => "file",
                    "placeholder" => "Ajouter un thumbnail",
                    "label" => "Thumbnail",
                    "required" => false
                ]
            ]
        ];
    }

}
