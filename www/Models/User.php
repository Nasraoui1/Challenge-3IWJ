<?php
namespace App\Models;

use App\Core\SQL;
use DateTime;
use PDO;

class User extends SQL
{
    protected ?int $id = null;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected ?string $password = null;
    protected int $id_role;
    protected ?DateTime $birthday = null;
    protected ?DateTime $creation_date = null;
    protected ?DateTime $modification_date = null;
    protected string $token = "";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function login(string $email, string $password): bool
    {
        // Query to get user details by email
        $sql = "SELECT id, email, password, id_role FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and verify the password
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id_role'] = $user['id_role'];
                return true;
            }
        } catch (PDOException $e) {
            die('SQL Error: ' . $e->getMessage());
        }

        return false;
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

    public function setToken($token): void
    {
        $this->token = $token;
        $this->token_expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));
    }

    public function getToken(): ?string
    {
        return $this->token;
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

    public function createUser($firstname, $lastname, $email, $password, $id_role)
    {
        $activation_token = $this->generateToken();
        $stmt = $this->pdo->prepare("INSERT INTO chall_users (firstname, lastname, email, password, id_role, activation_token) VALUES (:firstname, :lastname, :email, :password, :id_role, :activation_token)");
        $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $this->hashPassword($password),
            'id_role' => $id_role,
            'activation_token' => $activation_token,
        ]);
        return $activation_token;
    }

    public function generateToken()
    {
        return bin2hex(random_bytes(16));
    }

    public function activateUser($token) {
        $stmt = $this->db->prepare("UPDATE chall_users SET is_verified = TRUE WHERE verification_token = :token");
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }


    public function storeVerificationToken($email, $token) {
        $stmt = $this->db->prepare("UPDATE chall_users SET verification_token = ? WHERE email = ?");
        $stmt->execute([$token, $email]);
    }

    public function verifyUser($token) {
        $stmt = $this->db->prepare("SELECT * FROM chall_users WHERE verification_token = ?");
        $stmt->execute([$token]);
        $user = $stmt->fetch();

        if ($user) {
            $stmt = $this->db->prepare("UPDATE chall_users SET is_verified = 1, verification_token = NULL WHERE id = ?");
            return $stmt->execute([$user['id']]);
        }

        return false;
    }


}