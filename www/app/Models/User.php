<?php

namespace App\Models;

use Core\enums\Role;
use Core\ORM;

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
    protected string $access_token;
    protected string $user_description;

    protected Role $role = Role::USER;


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

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getUserDescription(): string
    {
        return $this->user_description;
    }

    public function setUserDescription(string $user_description): void
    {
        $this->user_description = $user_description;
    }

    public function setDateInserted(string $date_inserted): void
    {
        $this->date_inserted = $date_inserted;
    }

    public function setDateUpdated(string $date_updated): void
    {
        $this->date_updated = $date_updated;
    }

    public function getRole(): Role
    {
        return $this->role;
    }
    public function setRole(Role $role): void
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
}