<?php

class FormValidation{

    /**
     * @var object
     */
    protected $object;

    /**
     * @var String
     */
    protected $formName;

    /**
     * @var array
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * FormValidation constructor.
     * @param $object
     * @param $formName
     * @param $request
     */
    function __construct($object, $formName, $request)
    {
        $this->object = $object;
        $this->formName = $formName;
        $this->request = $request;
        $this->form = $object->{$formName."Form"}();

        $this->query = $request->{'get'.$this->form['struct']['method'].'Query'}();
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function valid(){

        if ($this->form['struct']['method'] !== $this->request->getRequestType()) {
            return false;
        }

        if (!$this->request->goodToken($this->query['token'])){
            $this->errors[] = "Bad token";
            return false;
        }

        if (isset($this->form['struct']['captcha']) && $this->form['struct']['captcha'] && !$this->validCaptcha()){
            $this->errors[] = "Bad captcha";
            return false;
        }
        dump('ok 3');


        if (!$this->checkInput()) {
            return false;
        }

        $this->hydratation();
        return true;
    }

    public function validCaptcha(){

    }

    public function hydratation(){
        foreach ($this->data as $name => $data) {
            $this->object->{'set'.ucfirst($name)}($data);
        }
    }

    public function checkInput(){

        foreach ($this->form['data'] as $name => $data) {
            $validation = $data['validation'];

            if (!empty($validation['type'])) {
                $this->{'check'.$validation['type']}($name);
            }
        }

        if (count($this->errors) !== 0){
            return false;
        }

        return true;
    }




    /**
     * @return array
     */
    public function checkEmail($name)
    {
        $email = $this->query[$name];

        // check

        // if good
        $this->data[$name] = $email;
        // else
        $this->errors[] = $name. " est invalide";
    }

}