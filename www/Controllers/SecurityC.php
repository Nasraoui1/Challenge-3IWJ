<?php

namespace App\Controller;

use App\Core\Form;
use App\Core\View;
use App\Models\User;
use Mailer;
use PHPMailer\PHPMailer\PHPMailer;

class SecurityC {
    private $userModel;
    private $mailer;

    public function __construct() {
        $this->userModel = new User();
        $this->mailer = new Mailer();
    }

    public function register() {
        $form = new Form('Register');
        if ($form->isSubmitted() && $form->isValidd()) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'] ?? null;
            $id_role= 0;
            $this->userModel->createUser($firstname, $lastname, $email, $password,$id_role, $birthday);
            header('Location: /login');
            exit;
        }

        $view = new View("Security/Register");
        $view->render();
    }

    public function activate() {
        $token = $_GET['token'] ?? '';
        if ($this->userModel->activateUser($token)) {
            $_SESSION['message'] = 'Your account has been activated. You can now log in.';
        } else {
            $_SESSION['error'] = 'Invalid activation token.';
        }
        header('Location: /login');
        exit;
    }



    public function login() {
        $form = new Form('Login'); // Assuming you have a Form class
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->login($email, $password)) {
                header('Location: /home');
                exit;
            } else {
                $_SESSION['error'] = 'Invalid email or password';
                header('Location: /login');
                exit;
            }
        }

        if (isset($_SESSION['error'])) {
            $error_message = $_SESSION['error'];
            unset($_SESSION['error']);
        } else {
            $error_message = '';
        }

        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $message = '';
        }

        $view = new View("Security/login"); // Assuming you have a View class
        $view->render(['error_message' => $error_message, 'message' => $message]);
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
    public function showResetPasswordForm() {
        include dirname(__DIR__) . '/Views/resetpassword.php';
    }
    public function processResetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $user = $this->userModel->getUserByEmail($email);

            if ($user) {
                // Generate reset token and expiration
                $resetToken = bin2hex(random_bytes(16));
                $resetExpires = new \DateTime('+1 hour');
                $this->userModel->setResetToken($resetToken);
                $this->userModel->setResetExpires($resetExpires);

                // Update user in the database
                $this->userModel->updateUser($user['id'], $user['firstname'], $user['lastname'], $user['email'], $user['id_role']);

                // Send reset email (you need to implement the sendResetEmail method)
                // $this->sendResetEmail($user['email'], $resetToken);

                $_SESSION['success'] = 'A reset link has been sent to your email.';
            } else {
                $_SESSION['error'] = 'No account found with that email address.';
            }

            header('Location: /resetpassword');
            exit;
        }
    }
}
