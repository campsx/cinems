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
     * @param $query
     */
    function __construct($object, $formName, $query = null)
    {
        $this->request = Request::getInstance();
        $this->object = $object;
        $this->formName = $formName;
        $this->form = $object->{$formName."Form"}();

        if ($query === null){
            $this->query = $this->request->{'get'.$this->form['struct']['method'].'Query'}();
        } else {
            $this->query = $query;
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->form;
    }

    /**
     * @return String
     */
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    public function valid(){

       if(!$this->validation()) {
           $this->request->session()->generateToken($this->formName);
           return false;
       }

        $this->hydratation();
       return true;
    }

    public function validation(){

        // check if a good method
        if ($this->form['struct']['method'] !== $this->request->getRequestType()) {
            return false;
        }

        // check if a good token
        if ( !isset($this->query['token_'.$this->formName]) || !$this->request->goodToken($this->query['token_'.$this->formName], $this->formName)){
            $this->errors[] = "Bad token";
            return false;
        }

        // check if a good captcha if capcha
        if (isset($this->form['struct']['capcha']) && $this->form['struct']['capcha'] && !$this->validCaptcha()){
            $this->errors[] = "Bad capcha";
            return false;
        }


        if (!$this->checkInput()) {
            return false;
        }

        return true;
    }

    /**
     * Check if a good capcha
     * @return bool
     */
    public function validCaptcha(){
        return $this->getRequest()->session()->getSession('capcha') === $this->query['capcha'];
    }

    /**
     * hydrate object with new data
     */
    public function hydratation(){
        foreach ($this->data as $name => $data) {
            $this->object->{'set'.ucfirst($name)}($data);
        }
    }


    /**
     * Check all field in the form
     * @return bool
     */
    public function checkInput(){

        foreach ($this->form['data'] as $nameField => $data) {

            if (!isset($this->query[$nameField])) {
                $this->errors[] = $nameField. " est vide";
                continue;
            }

            if (!empty($data['type'])) {
                $this->{'check'.ucfirst($data['type'])}($nameField);
            }

            // add data in data array
            $this->data[$nameField] = $this->query[$nameField];

            // if not validation
            if (!isset($data['validation'])) {
                continue;
            }

            $validation = $data['validation'];

            if (!empty($validation['unique']) && $validation['unique'] === true) {
                $this->checkUnique($nameField);
            }

            if (!empty($validation['length'])) {
                $this->checkLength($nameField, $validation['length']);
            }

            if (!empty($validation['interval'])) {
                $this->checkDateInterval($nameField, $validation['interval']);
            }

        }

        dump($this->errors);
        dump_exit($this->data);

        if (count($this->errors) !== 0){
            return false;
        }

        return true;
    }


    // Check TYPE ------------------------------------------------------------------------------------------------------

    /**
     * @return void
     */
    public function checkEmail($nameField)
    {
        $email = $this->query[$nameField];
    }

    /**
     * @return void
     */
    public function checkText($nameField)
    {

    }

    /**
     * @return void
     */
    public function checkPassword($nameField)
    {

    }

    /**
     * @return void
     */
    public function checkDate($nameField)
    {
        $date = $this->query[$nameField];

        //2016-12-13 or 13/12/2016
        $pattern = (strpos($date, "-"))?"Y-m-d":"d/m/Y";
        $date = DateTime::createFromFormat($pattern, $date);
        $dateErrors = DateTime::getLastErrors();
        if(!($dateErrors["warning_count"]+$dateErrors["error_count"]==0)){
            $this->errors[] = $nameField. " est invalide";
        }
    }

    // Check CRITERIA --------------------------------------------------------------------------------------------------

    /**
     * @return void
     */
    public function checkUnique($nameField)
    {
        $email = $this->query[$nameField];

    }

    /**
     * @return void
     */
    public function checkLength($nameField, $maxMin)
    {
        $email = $this->query[$nameField];
    }

    /**
     * @return void
     */
    public function checkDateInterval($nameField, $maxMin)
    {
        $date = $this->query[$nameField];

        //2016-12-13
        //13/12/2016
        $pattern = (strpos($date, "-"))?"Y-m-d":"d/m/Y";
        $date = DateTime::createFromFormat($pattern, $date);
        $dateErrors = DateTime::getLastErrors();
        if($dateErrors["warning_count"]+$dateErrors["error_count"]==0){
            $dateToday = new dateTime();
            $age = $date->diff($dateToday)->format("%y");
            if($age<$maxMin['min']){
                $this->errors[] = $nameField. " est invalide";
            } elseif ($age>$maxMin['max']) {

            }
        }
    }

}