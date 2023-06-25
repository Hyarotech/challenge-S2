<?php

namespace App\Notifications;

use Core\Mail;
use Core\Router;

class VerifyUserEmailNotification extends \Core\Notification
{

    public function __construct(
        array $data
    )
    {
        parent::__construct();
        $this->setData($data);
        $this->execute();
    }

    public function execute(): void
    {

        $url = env("APP_URL") . Router::generateDynamicRoute("security.verifEmail", ["token" => urlencode($this->get("verif_token")), "email" => urlencode($this->get("email"))]);
        $mail = new Mail();
        $mail->send(
            "Email verification",
            "verif_email",
            env("APP_FROM_EMAIL"),
            env("APP_NAME"),
            $this->get("email"),
            $this->get("firstname") . " " . $this->get("lastname"),
            [
                "url" => $url,
            ]
        );
    }
}