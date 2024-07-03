<?php

namespace App\Controller;
use App\Models\User;
use App\Core\Form;
use App\Core\View;
use App\Core\Mailer; // Assuming Mailer class is within App\Core namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\Security as Auth;

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



    public function login(): void
    {
        $user = new User();
        $security = new Auth();

        // Check if the user is already logged in
        if ($security->isLoggedIn()) {
            echo "Vous êtes déjà connecté";
            return;
        }

        $form = new Form("Login");

        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Attempt to log in
            if ($user->login($email, $password)) {

                // Start session if not already started
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }

                // Store user details in session
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['id_role'] = $user->getIdRole();

                // Redirect to home page
                header("Location: /home");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        }

        // Render the login view
        $view = new View("Security/login");
        $view->assign("form", $form->build());
        $view->render();
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
