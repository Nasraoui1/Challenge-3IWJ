<?php
namespace App\Controller;

use App\Core\View;

class Main
{
    public function __construct()
    {
        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function home()
    {
        // Check if id_role is set in the session
        $id_role = $_SESSION['id_role'] ?? null;
        // Assign id_role to the view and render the view
        $view = new View("home");
        $view->assign("id_role", $id_role);
        $view->render();
    }

    public function logout()
    {
        // Handle logout logic
        session_destroy(); // Destroy the session
        header("Location: /login"); // Redirect to the home page or login page
        exit();
    }
}
