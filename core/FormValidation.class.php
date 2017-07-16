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
     * @var string
     */
    protected $infoFile = null;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $selectList = [];

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
        $this->filesQuery = $this->request->getFILESQuery();

        if ($query === null){
            $this->query = $this->request->{'get'.$this->form['struct']['method'].'Query'}();
        } else {
            $this->query = $query;
        }
    }

    /**
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }

    private function addErrors($string, $data = [])
    {
        $this->errors[] = vsprintf($string, $data);
    }

    public function addSelectList($name, $data = [])
    {
        $this->selectList[$name] = $data;
    }

    /**
     * @return array
     */
    public function getSelectList($name)
    {
        return $this->selectList[$name];
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
    public function getForm()
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

    public function generateNewToken(){
        return $this->request->session()->generateToken($this->formName);
    }

    /**
     * @param $token DateTime
     * @return bool
     */
    public function tokenNotExpirate($tokenDate)
    {
        return $tokenDate > new DateTime();
    }

    public function valid($hydrate = true){

       if(!$this->validation()) {
           return false;
       }

       if ($hydrate === true){
           $this->hydratation();
       }

       return true;
    }

    public function validation(){

        // check if a good method
        if ($this->form['struct']['method'] !== $this->request->getRequestType()) {
            return false;
        }

        // check if a good token
        if ( !isset($this->query['token_'.$this->formName]) || !$this->request->goodToken($this->query['token_'.$this->formName], $this->formName)){
            $this->addErrors(Errors::BAD_TOKEN);
            return false;
        }

        // check if a good captcha if capcha
        if (isset($this->form['struct']['capcha']) && $this->form['struct']['capcha'] && !$this->validCaptcha()){
            $this->addErrors(Errors::BAD_CAPCHA);
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

        if (isset($this->getForm()["initData"])){
            foreach ($this->getForm()["initData"] as $name => $data){
                $this->data[$name] = $data;
            }
        }

        foreach ($this->data as $name => $data) {
            if (isset($this->form['data'][$name]) && $this->form['data'][$name]['type'] == 'entity') {
                if(is_array($data)){

                    $oldData = $this->object->{'get'.ucfirst($name)}();
                    // add new data
                    foreach ($data as $entityId) {
                        if (!$this->inArrayEntity($oldData, $entityId)) {
                            $this->object->{'add'.ucfirst($this->form['data'][$name]['entityName'])}($entityId);
                        }
                    }
                    // remove old data
                    foreach ($oldData as $entity) {
                        if (!$this->inArrayEntity($data, $entity->getId())) {
                            $this->object->{'remove'.ucfirst($this->form['data'][$name]['entityName'])}($entity);
                        }
                    }

                } else {
                    $this->object->{'set'.ucfirst($this->form['data'][$name]['entityName'])}($data);
                }
            } else {
                $this->object->{'set'.ucfirst($name)}($data);
            }
        }
    }

    /**
     * set file
     */
    public function setFile($nameField)
    {
        if ($this->filesQuery[$nameField]['error'] == 0) {
            $this->infoFile = $this->filesQuery[$nameField];
            $info = new SplFileInfo($this->filesQuery[$nameField]['name']);
            $name = md5(session_id().microtime()) . '.' . $info->getExtension();
            $this->infoFile['urlName'] = $name;
        }
    }

    public function getFile()
    {
        return $this->infoFile;
    }


    /**
     * Check all field in the form
     * @return bool
     */
    public function checkInput(){

        foreach ($this->form['data'] as $nameField => $data) {

            if ($data['type'] == "file") {
                $this->checkFile($nameField);
                $this->setFile($nameField);
                $this->fileName = $nameField;
                continue;
            }

            if (!isset($this->query[$nameField])) {
                $this->addErrors(Errors::FIELD_NO_ISSET, [$nameField]);
                continue;
            }

            // empty('0') == true
            if (empty($this->query[$nameField]) && $this->query[$nameField] != '0'){
                if($data['required'] === true){
                    $this->addErrors(Errors::FIELD_EMPTY, [$nameField]);
                }
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

            if (in_array('unique', $validation)) {
                $this->checkUnique($nameField);
            }

            if (!empty($validation['length'])) {
                $this->checkLength($nameField, $validation['length']);
            }

            if (!empty($validation['lengthNumber'])) {
                $this->checkLengthNumber($nameField, $validation['lengthNumber']);
            }

            if (!empty($validation['interval'])) {
                $this->checkDateInterval($nameField, $validation['interval']);
            }

            if (in_array('slug', $validation)) {
                $this->checkSlug($nameField);
            }

        }

        if (count($this->errors) !== 0){
            return false;
        }

        return true;
    }

    /**
     * @param $array
     * @param $id
     * @return bool
     */
    private function inArrayEntity($array, $id){
        foreach ($array as $entity) {
            if (is_object($entity)) {
                if ($entity->getId() == $id) {
                    return true;
                }
            } else {
                if ($entity == $id) {
                    return true;
                }
            }
        }
        return false;
    }


    // Check TYPE ------------------------------------------------------------------------------------------------------

    /**
     * @return void
     */
    public function checkEmail($nameField)
    {
        $email = $this->query[$nameField];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->addErrors(Errors::EMAIL_NO_VALID, [$email]);
        }
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
    public function checkTextarea($nameField)
    {

    }

    /**
     * @return void
     */
    public function checkNumber($nameField)
    {
        $number = $this->query[$nameField];
        if ($number != '0' && (int) $number == 0) {
            $this->addErrors(Errors::DATE_A_NUMBER, [$nameField]);
        }
    }

    /**
     * @return void
     */
    public function checkFile($nameField)
    {
        // @todo check file format img
        $this->filesQuery[$nameField];
    }

    /**
     * @return void
     */
    public function checkEntity($nameField)
    {
        $data = $this->query[$nameField];
        $entityName = $this->form['data'][$nameField]['entityName'];
        if ($this->form['data'][$nameField]['multiple']) {
            if (is_array($data)) {
                foreach ($data as $entityId) {
                    $entity = new $entityName(['id' => $entityId]);
                    if ($entity->getId() == -1) {
                        $this->addErrors(Errors::ENTITY_BAD, [$nameField]);
                    }
                }
            } else {
                $this->addErrors(Errors::ENTITY_MULTIPLE, [$nameField]);
            }
        } else {
            if ((int)$data != 0) {
                $entity = new $entityName(['id' => $data]);
                if ($entity->getId() == -1) {
                    $this->addErrors(Errors::ENTITY_BAD, [$nameField]);
                }
            } else {
                $this->addErrors(Errors::ENTITY_NO_MULTIPLE, [$nameField]);
            }
        }

    }

    /**
     * @return void
     */
    public function checkDate($nameField)
    {
        $date = $this->query[$nameField];

        //2016-12-13 or 13/12/2016
        $pattern = (strpos($date, "-"))?"Y-m-d":"d/m/Y";
        $dateTest = DateTime::createFromFormat($pattern, $date);
        $dateErrors = DateTime::getLastErrors();
        if(!($dateErrors["warning_count"]+$dateErrors["error_count"]==0)){
            $this->addErrors(Errors::DATE_NOT_VALID, [$date]);
        }
    }

    /**
     * @return void
     */
    public function checkMultiple($nameField)
    {
        $data = $this->query[$nameField];
        foreach ($data as $value) {
            if (!in_array($value, $this->form['data'][$nameField]["choice"])){
                $this->addErrors(Errors::MULTIPLE_NO_EXIST, [$value, $nameField]);
            }
        }

    }

    /**
     * @return void
     */
    public function checkRadioTrueFalse($nameField)
    {
        if ($this->query[$nameField] != 0 && $this->query[$nameField] != 1) {
            $this->addErrors(Errors::TRUE_FALSE, [$nameField]);
        }
    }

    // Check CRITERIA --------------------------------------------------------------------------------------------------

    /**
     * @return void
     */
    public function checkUnique($nameField)
    {
        $field = $this->query[$nameField];
        if(!$this->object->unique($nameField, $field)){
            $this->addErrors(Errors::UNIQUE, [$nameField, $field]);
        }
    }

    /**
     * @return void
     */
    public function checkLengthNumber($nameField, $maxMin)
    {
        $number = $this->query[$nameField];

        if ((int)$number < $maxMin['min']){
            $this->addErrors(Errors::LENGTH_NUMBER_MIN, [$nameField, $maxMin['min'], $maxMin['max']]);
        } elseif ((int)$number > $maxMin['max']){
            $this->addErrors(Errors::LENGTH_NUMBER_MAX, [$nameField, $maxMin['min'], $maxMin['max']]);
        }
    }

    /**
     * @return void
     */
    public function checkLength($nameField, $maxMin)
    {
        $string = $this->query[$nameField];

        if (strlen($string) < $maxMin['min']){
            $this->addErrors(Errors::LENGTH_MIN, [$nameField, $maxMin['min'], $maxMin['max']]);
        } elseif (strlen($string) > $maxMin['max']){
            $this->addErrors(Errors::LENGTH_MAX, [$nameField, $maxMin['min'], $maxMin['max']]);
        }
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
        $dateTest = DateTime::createFromFormat($pattern, $date);
        $dateErrors = DateTime::getLastErrors();
        if($dateErrors["warning_count"]+$dateErrors["error_count"]==0){
            $dateToday = new dateTime();
            $age = $dateTest->diff($dateToday)->format("%y");
            if($age<$maxMin['min']){
                $this->addErrors(Errors::INTERVAL_MIN, [$nameField, $date, $maxMin['min'], $maxMin['max']]);
            } elseif ($age>$maxMin['max']) {
                $this->addErrors(Errors::INTERVAL_MAX, [$nameField, $date, $maxMin['min'], $maxMin['max']]);
            }
        }
    }

    public function checkSlug($nameField){
        $slug = $this->query[$nameField];
        if(!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)){
            $this->addErrors(Errors::SLUG_NOT_VALID);
        }
    }

}