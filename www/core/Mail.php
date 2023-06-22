<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $is_dev = env("APP_ENV") === "dev";
        $this->mailer = new PHPMailer($is_dev);
        $this->mailer->SMTPDebug = SMTP::DEBUG_OFF;
        $this->mailer->isSMTP();
        $this->mailer->Host = env("SMTP_HOST");
        $this->mailer->SMTPAuth = env("SMTP_AUTH", false);
        if (env("SMTP_AUTH", false)) {
            $this->mailer->Username = env("SMTP_USERNAME");
            $this->mailer->Password = env("SMTP_PASSWORD");
        }
        if (env("SMTP_SECURE", false)) {
            $this->mailer->SMTPSecure = env("SMTP_SECURE_PROTOCOL", PHPMailer::ENCRYPTION_SMTPS);
        }
        $this->mailer->Port = env("SMTP_PORT");
        $this->mailer->CharSet = PHPMailer::CHARSET_UTF8;
        $this->mailer->isHTML();
    }

    /**
     * @return PHPMailer
     */
    public function getMailer(): PHPMailer
    {
        return $this->mailer;
    }

    public function getView(string $view,$data): false|string
    {
        if(!file_exists(ROOT . "/resources/mails/" . $view . ".mail.php")) die("View not found");

        ob_start();
        extract($data);
        require ROOT . "/resources/mails/" . $view . ".mail.php";
        return ob_get_clean();
    }

    public function send(
        string $subject,
        string $view,
        string $fromEmail,
        string $fromName,
        string $toEmail,
        string $toName,
        array $data = []
    ): bool
    {
        $content = $this->getView($view,$data);
        if($content === false) return false;
        try {
            $this->mailer->setFrom($fromEmail, $fromName);
            $this->mailer->addAddress($toEmail, $toName);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $content;
            return $this->mailer->send();
        } catch (\Exception $e) {
            return false;
        }
    }

}