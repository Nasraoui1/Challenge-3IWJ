<?php
namespace App\Models;

use App\Core\SQL;
use DateTime;

class User extends SQL
{
    protected ?int $id = null;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected ?string $password = null;
    protected int $id_role;
    protected ?string $reset_token = null;
    protected ?DateTime $reset_expires = null;
    protected ?string $activation_token = null;
    protected ?DateTime $birthday = null;
    protected ?DateTime $creation_date = null;
    protected ?DateTime $modification_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        if ($password) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    public function getIdRole(): int
    {
        return $this->id_role;
    }

    public function setIdRole(int $id_role): void
    {
        $this->id_role = $id_role;
    }

    public function getResetExpires(): ?DateTime
    {
        return $this->reset_expires;
    }

    public function setResetExpires(?DateTime $reset_expires): void
    {
        $this->reset_expires = $reset_expires;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): void
    {
        $this->reset_token = $reset_token;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): void
    {
        $this->activation_token = $activation_token;
    }

    public function getBirthday(): ?DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(?DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getCreationDate(): ?DateTime
    {
        return $this->creation_date;
    }

    public function setCreationDate(?DateTime $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function getModificationDate(): ?DateTime
    {
        return $this->modification_date;
    }

    public function setModificationDate(?DateTime $modification_date): void
    {
        $this->modification_date = $modification_date;
    }
}
