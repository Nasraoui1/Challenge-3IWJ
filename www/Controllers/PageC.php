<?php

namespace App\Controller;

use App\Core\View;
use App\Core\Form;
use App\Models\Page;

class PageC
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function create()
    {
        $form = new Form("CreatePage");
        $view = new View("createpage");
        $view->assign("form", $form->build());
        $view->render();
    }

    public function store()
    {
        $form = new Form("CreatePage");

        if ($form->isSubmitted() && $form->isValid()) {
            $page = new Page();
            $page->setTitle($_POST['title']);
            $page->setContent($_POST['content']);
            $page->setDescription($_POST['description'] ?? null);
            $page->setUserId($_SESSION['user_id'] ?? null);
            $page->setSlug($_POST['slug']);

            if ($page->save()) {
                header("Location: /list-page");
                exit();
            } else {
                echo "There was an error saving the page.";
            }
        } else {
            echo "There was an error creating the page.";
            foreach ($form->getErrors() as $error) {
                echo "<p>$error</p>";
            }
        }
    }

    public function list()
    {
        $pageModel = new Page();
        $pages = $pageModel->getAllPages();
        $view = new View("listPage");
        $view->assign("pages", $pages);
        $view->render();
    }

    public function view($params)
    {
        if (!isset($params['slug'])) {
            echo "No page slug specified.";
            return;
        }

        $slug = $params['slug'];
        $page = (new Page())->getPageBySlug($slug);
        if ($page === null) {
            echo "Page not found.";
            return;
        }

        $view = new View("viewPage");
        $view->assign("page", $page);
        $view->render();
    }

    public function edit()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "Invalid page ID.";
            return;
        }

        $pageId = (int)$_GET['id'];
        $page = (new Page())->getPageById($pageId);

        if ($page === null) {
            echo "Page not found.";
            return;
        }

        $form = new Form("EditPage");
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $form->isSubmitted() && $form->isValid()) {
            $page->setTitle($_POST['title']);
            $page->setContent($_POST['content']);
            $page->setDescription($_POST['description'] ?? null);
            $page->setSlug($_POST['slug']);

            if ($page->save()) {
                header("Location: /dashboard");
                exit();
            } else {
                echo "There was an error updating the page.";
            }
        } else {
            $form->setValues($page->toArray());
        }

        $view = new View("editPage");
        $view->assign("form", $form->build());
        $view->render();
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "Invalid page ID.";
            return;
        }

        $pageId = (int)$_GET['id'];
        $page = new Page();

        if ($page->deleteById($pageId)) {
            header("Location: /dashboard");
            exit();
        } else {
            echo "There was an error deleting the page.";
        }
    }
}
