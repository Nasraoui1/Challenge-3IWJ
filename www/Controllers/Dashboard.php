<?php

namespace App\Controller;

use App\Core\Security;
use App\Core\SQL;

class Dashboard {

    protected SQL $db;

    public function __construct() {
        $this->db = new SQL();
    }

    public function index() {
        if (!Security::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        $userCount = $this->db->getUserCount();
        $elementsCount = [
            'users' => $userCount,
        ];

        $content = '../Views/dashboard.php';
        include '../Views/dashboardTemplate.php';
    }

    public function getUsersCount() {
        $userCount = $this->db->getUserCount();
        $content = '../Views/users.php'; // Path to the users view
        include '../Views/dashboardTemplate.php';
    }

    public function getUsers() {
        $users = $this->db->getAllUsers();
        $content = '../Views/users.php'; // Path to the users view
        include '../Views/dashboardTemplate.php';
    }

    public function addUserForm() {
        $content = '../Views/addUserForm.php';
        include '../Views/dashboardTemplate.php';
    }

    public function addUser() {
        // Traitement du formulaire pour ajouter l'utilisateur
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id_role = $_POST['id_role'];

        // Ajout de l'utilisateur dans la base de données
        $this->db->createUser($firstname, $lastname, $email, $password, $id_role, null);

        // Redirection vers la vue des utilisateurs
        header('Location: /dashboard/users');
        exit;
    }

    public function updateUserForm() {
        $id = $_POST['id'];
        $user = $this->db->getUserById($id);
        $content = '../Views/updateUserForm.php';
        include '../Views/dashboardTemplate.php';
    }

    public function updateUser() {
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $success = $this->db->updateUser($id, $firstname, $lastname, $email, $role);
        if ($success) {
            header('Location: /dashboard/users');
            exit;
        } else {
            echo 'Error updating user';
        }
    }

    public function deleteUser() {
        $id = $_POST['id'];
        $success = $this->db->deleteUser($id);
        if ($success) {
            header('Location: /dashboard/users');
            exit;
        } else {
            echo 'Error deleting user';
        }
    }
}
