<?php
namespace App\Controller;

use App\Core\View;



class Main
{
    public function home()
    {
        $id_role = $_GET["id_role"];
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