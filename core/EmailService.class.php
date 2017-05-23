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

    const CHANGE_PASSWORD_SUBJECT = "Mail oublie de mots de pass";

    const CHECK_EMAIL_BODY = "
        <h1>Bonjour %s,</h1>
        <p>Vous venez de vous inscrire sur le site CineMS</p>
        <p>Nous vous envoyons un lien valable pour confirmer votre compte</p>
        <p>Si le lien n'ai plus contacter l'admin du site.</p>
        <a href='%s'>Lien pour comfirmer votre compte</a>
        ";

    const CHECK_EMAIL_SUBJECT = "Confirme email";

    protected $phpMailer;

    /**
     * @var Email
     */
    protected $email;

    /**
     * @var User
     */
    protected $user;

    protected $body;

    function __construct($email)
    {
        $this->email = $email;
        $this->user = $this->email->getUser();

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

        $this->phpMailer->addAddress($this->user->getEmail(), $this->user->getPseudo());
        $this->phpMailer->Body = $this->email->getContent();

        $this->phpMailer->Subject = $this->email->getSubject();
        $this->phpMailer->AltBody = 'Votre clients email ne lis pas le format HTML.';
        $this->phpMailer->isHTML(true);
    }

    /**
     * @param PHPMailer $mail
     */
    public function sendMail()
    {
        return $this->phpMailer->send();
    }




}