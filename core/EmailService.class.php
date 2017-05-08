<?php

require VENDOR_EMAIL.'PHPMailerAutoload.php';

class EmailService{

    const CHANGE_PASSWORD_BODY = "
        <h1>Bonjour %s,</h1>
        <p>Vous avez fait une demande de mots de pass oublié</p>
        <p>Nous vous envoyons un lien valable 15 minutes pour changer votre mots de pass</p>
        <p>Si le lien n'ai plus valable recommançais la demarche.</p>
        <a href='%s'>Lien pour changer de mots de pass</a>
        ";

    protected $phpMailer;

    protected $email;

    protected $body;

    function __construct($email)
    {
        $this->phpMailer = new PHPMailer;
        $this->phpMailer->CharSet = 'UTF-8';

            //Tell PHPMailer to use SMTP
        $this->phpMailer->isSMTP();

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
        if (ENV_IS_DEV){
            //$this->mail->SMTPDebug = 2;
            $this->phpMailer->Debugoutput = 'html';
        } else {
            $this->phpMailer->SMTPDebug = 0;
        }

        $this->phpMailer->Host = 'smtp.gmail.com';
        $this->phpMailer->Port = 587;
        $this->phpMailer->SMTPSecure = 'tls';
        $this->phpMailer->SMTPAuth = true;
        $this->phpMailer->Username = EMAIL_USERNAME;
        $this->phpMailer->Password = EMAIL_PASSWORD;
        $this->phpMailer->setFrom(EMAIL_USERNAME, 'Admin cinems');

        $this->setBody($body);
        $this->setData($data);
        $this->setSubject($subject);
        $this->setAltBody($subject);
        $this->phpMailer->Subject = 'Here is the subject';
        $this->phpMailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $this->phpMailer->isHTML(true);
    }

    /**
     * @param PHPMailer $mail
     */
    public function sendMail()
    {
        return $this->phpMailer->send();
    }

    /**
     * @return String $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param String $body
     */
    public function setBody($body, $data)
    {
        $this->phpMailer->Body = vsprintf($this->getBody(), $this->getData());
    }


    public function addAddressTo($email, $name = "")
    {
        $this->phpMailer->addAddress($email, $name);
    }




}