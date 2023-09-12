<?php

namespace App\Models;

use Core\Model;
use DateTime;

class User extends Model
{
    protected int $id = 0;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected bool $verified = false;
    protected DateTime $dateInserted;
    protected DateTime $dateUpdated;
    protected ?string $verifToken;
    protected ?string $accessToken;
    protected ?string $userDescription;

    protected int $role = 0;

    protected ?array $fillable = [
        "firstname",
        "lastname",
        "email",
        "password",
        "verified",
        "verif_token",
        "user_description",
        "role",
        "access_token"
    ];


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

    /**
     * @return DateTime
     */
    public function getDateInserted(): DateTime
    {
        return $this->dateInserted;
    }

    /**
     * @param DateTime $dateInserted
     */
    public function setDateInserted(DateTime $dateInserted): void
    {
        $this->dateInserted = $dateInserted;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param DateTime $dateUpdated
     */
    public function setDateUpdated(DateTime $dateUpdated): void
    {
        $this->dateUpdated = $dateUpdated;
    }


    public function isVerified(): bool
    {
        return $this->verified;
    }

    public function setVerified(bool $verified): void
    {
        $this->verified = $verified;
    }

    public function getVerifToken(): string|null
    {
        return $this->verifToken;
    }

    public function setVerifToken(?string $verifToken): void
    {
        $this->verifToken = $verifToken;
    }

    public function getUserDescription(): string
    {
        return $this->userDescription;
    }

    public function setUserDescription(?string $userDescription): void
    {
        $this->userDescription = $userDescription;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param string|null $accessToken
     */
    public function setAccessToken(?string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function hasRole(int $role): bool
    {
        return $this->role === $role;
    }
}
