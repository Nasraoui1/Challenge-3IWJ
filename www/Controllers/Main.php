<?php
namespace App\Controller;

use App\Core\View;
use App\Core\SQL;
use App\Models\StatUser;
use App\Models\User;
use App\Models\Page;
use App\Models\Media;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Setting;
use App\Models\Status;
use App\Models\Role;


class Main
{
    public function home()
    {
        include dirname(__DIR__) . '/Views/home.php';
    }
    public function logout()
    {
        //Déconnexion
        //Redirection
    }

}