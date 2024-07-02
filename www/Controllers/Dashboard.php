<?php

namespace App\Controller;

use App\Core\Security;
use App\Core\SQL;
use App\Core\View;

class Dashboard {

    protected SQL $db;

    public function __construct() {
        $this->db = new SQL();
        $this->checkAdmin(); // Check admin access on instantiation
    }

    private function checkAdmin() {
        if (!Security::isLoggedIn() || $_SESSION['id_role'] != 1) {
            header('Location: /login');
            exit;
        }
    }

    public function index() {
        $userCount = $this->db->getUserCount();
        $adminCount = $this->db->getAdminCount();
        $elementsCount = [
            'users' => $userCount,
            'admin' => $adminCount,
            'pages' => 0 // Assuming you have logic to get the page count
        ];
        $content = '../Views/dashboard.php';
        include '../Views/dashboardTemplate.php';
    }

    public function getUsers() {
        $this->checkAdmin();
        $users = $this->db->getAllUsers();
        $content = '../Views/users.php';
        include '../Views/dashboardTemplate.php';
    }

    public function getAdmins() {
        $this->checkAdmin();
        $admins = $this->db->getUsersByRole(1);
        $content = '../Views/admins.php';
        include '../Views/dashboardTemplate.php';
    }

    public function addUserForm() {
        $this->checkAdmin();
        $content = '../Views/addUserForm.php';
        include '../Views/dashboardTemplate.php';
    }

    public function addUser() {
        $this->checkAdmin();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id_role = $_POST['id_role'];

        $this->db->createUser($firstname, $lastname, $email, $password, $id_role);
        header('Location: /dashboard/users');
        exit;
    }

    public function updateUserForm() {
        $this->checkAdmin();
        $id = $_POST['id'];
        $user = $this->db->getUserById($id);
        $content = '../Views/updateUserForm.php';
        include '../Views/dashboardTemplate.php';
    }

    public function updateUser() {
        $this->checkAdmin();
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $id_role = $_POST['id_role'];

        $this->db->updateUser($id, $firstname, $lastname, $email, $id_role);
        header('Location: /dashboard/users');
        exit;
    }

    public function deleteUser() {
        $this->checkAdmin();
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
