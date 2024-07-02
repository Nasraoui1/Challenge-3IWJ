<?php

namespace App\Core;

use PDO;
use PDOException;

class SQL {
    protected PDO $pdo;
    protected string $tablePrefix;

    public function __construct() {
        $dbname = getenv('DBNAME') ?: 'postgres_db';
        $dbuser = getenv('DBUSER') ?: 'postgres';
        $dbpwd = getenv('DBPWD') ?: 'postgres';
        $dbhost = getenv('DBHOST') ?: 'postgres_db';
        $dbport = getenv('DBPORT') ?: '5432';

        $dsn = "pgsql:host={$dbhost};port={$dbport};dbname={$dbname}";

        try {
            $this->pdo = new PDO($dsn, $dbuser, $dbpwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur: ' . $e->getMessage());
        }

        $this->tablePrefix = 'chall_';
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    public function createUser($firstname, $lastname, $email, $password,$id_role) {
        $stmt = $this->pdo->prepare("INSERT INTO chall_users (firstname, lastname, email, password,id_role) VALUES (:firstname, :lastname, :email, :password, :id_role)");
        $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $this->hashPassword($password),
            'id_role' => $id_role,
        ]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM chall_users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function getUserCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS count FROM chall_users WHERE id_role = 0");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['count'] : 0;
    }

    public function getAdminCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS count FROM chall_users WHERE id_role = 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['count'] : 0;
    }

    public function getPageCount() {
        // Placeholder for actual logic to get the page count
        return 0; // Adjust this as necessary
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM chall_users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM chall_users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsersByRole($role) {
        $stmt = $this->pdo->prepare("SELECT * FROM chall_users WHERE id_role = :role");
        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $firstname, $lastname, $email, $id_role) {
        $stmt = $this->pdo->prepare("UPDATE chall_users SET firstname = :firstname, lastname = :lastname, email = :email, id_role = :id_role WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'id_role' => $id_role
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM chall_users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
