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

    public function createUser($firstname, $lastname, $email, $password,$id_role, $birthday) {
        $stmt = $this->pdo->prepare("INSERT INTO users (firstname, lastname, email, password,id_role, birthday) VALUES (:firstname, :lastname, :email, :password, :id_role, :birthday)");
        $stmt->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $this->hashPassword($password),
            'id_role' => $id_role,
            'birthday' => $birthday
        ]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function getUserCount(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['count'];
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $firstname, $lastname, $email, $role) {
        $stmt = $this->pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, role = :role WHERE id = :id");
        return $stmt->execute([
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'role' => $role
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
