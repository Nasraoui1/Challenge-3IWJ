<?php

namespace App\Controller;

use App\Core\Form;
use App\Core\Security;
use App\Core\SQL;
use App\Core\Security\Auth;
use App\Core\View;

class SecurityC {
    protected SQL $db;

    public function __construct() {
        $this->db = new SQL();
    }

    public function register() {
        $form = new Form('Register');
        if ($form->isSubmitted() && $form->isValid()) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'] ?? null;
            $id_role= 1;
            $this->db->createUser($firstname, $lastname, $email, $password,$id_role, $birthday);
            header('Location: /login');
            exit;
        }

        $view = new View("Security/Register");
        $view->render();
    }

    public function login() {
        $form = new Form('Login');
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->db->getUserByEmail($email);
            if ($user && $this->db->verifyPassword($password, $user['password'])) {
                Security::login($user['id']);
                $_SESSION['email'] = $user['email'];
                header('Location: /home');
                exit;
            } else {
                echo 'Invalid email or password';
            }
        }
        $view = new View("Security/login");
        $view->render();
    }

    public function logout() {
        Security::logout();
        header('Location: /login');
        exit;
    }
}
