<?php

namespace App\Notifications;

class ForgotPasswordNotification extends \Core\Notification
{
    public function __construct(
        array $data
    ) {
        parent::__construct();
        $this->setData($data);
        $this->execute();
    }

    public function execute(): void
    {
        $this->mail->send(
            "Réinitialisation de votre mot de passe",
            "reset_password",
            env("APP_FROM_EMAIL"),
            env("APP_NAME"),
            $this->getData()["email"],
            "",
            [
                "token" => $this->getData()["reset_token"],
                "email" => $this->getData()["email"]
            ]
        );
    }
}
