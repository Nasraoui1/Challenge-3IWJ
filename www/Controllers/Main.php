<?php
namespace App\Controller;

use App\Core\View;



class Main
{
    public function home()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id_role = $_SESSION['id_role'];
        $view = new View("home");
        $view->assign("id_role", $id_role);
        $view->render();
    }
    public function logout()
    {
        //Déconnexion
        //Redirection
    }

}