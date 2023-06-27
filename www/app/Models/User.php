<?php

namespace App\Models;

use Core\enums\Role;
use Core\Mail;
use Core\ORM;
use Core\Router;
use Exception;

class User extends ORM
{

    protected int $id = 0;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected bool $verified = false;
    protected string $date_inserted;
    protected string $date_updated;
    protected ?string $access_token;
    protected ?string $user_description;

    protected string $role = "USER";


    public function alreadyExist(string $email)
    {
        $sql = "SELECT * FROM " . env('DB_SCHEMA', 'public') . ".user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getDateInserted(): string
    {
        return $this->date_inserted;
    }

    public function getDateUpdated(): string
    {
        return $this->date_updated;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): void
    {
        $this->verified = $verified;
    }

    public function getAccessToken(): string|null
    {
        return $this->access_token;
    }

    public function setAccessToken(?string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getUserDescription(): string
    {
        return $this->user_description;
    }

    public function setUserDescription(?string $user_description): void
    {
        $this->user_description = $user_description;
    }

    public function setDateInserted(?string $date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    public function setDateUpdated(?string $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    public function getRole(): string
    {
        return $this->role;
    }
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
    public function login(): bool
    {
        $sql = "SELECT * FROM " . env('DB_SCHEMA', 'public') . ".user WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":email", $this->getEmail());
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            if (password_verify($this->getPassword(), $user["password"])) {
                return true;
            }
        }
        return false;
    }

    public function verify(string $token)
    {
        $url = env("APP_URL").Router::generateDynamicRoute("security.verifEmail", ["token" => $token,"email" => $this->getEmail()]);
        $mail = new Mail();
        $mail->send(
            "Email verification",
            "verif_email",
            env("APP_FROM_EMAIL"),
            env("APP_NAME"),
            $this->getEmail(),
            $this->getFirstname()." ". $this->getLastname(),
            [
                "url" => $url,
            ]
        );

    }

    /**
     * @throws Exception
     */
    public static function hydrate(array $data): User
    {
        $user = new User();
        $user->setId($data["id"]);
        $user->setFirstname($data["firstname"]);
        $user->setLastname($data["lastname"]);
        $user->setEmail($data["email"]);
        $user->setPassword($data["password"]);
        $user->setVerified($data["verified"]);
        $user->setDateInserted($data["date_inserted"]);
        $user->setDateUpdated($data["date_updated"]);
        $user->setAccessToken($data["access_token"]);
        $user->setUserDescription($data["user_description"]);
        $user->setRole($data["role"]);
        return $user;
    }
}