<?php
// Include necessary files manually
require_once '../Core/SQL.php';
require_once '../Controllers/Dashboard.php';

// Use the necessary namespaces
use App\Controller\Dashboard;

// Create an instance of the Dashboard controller
$controller = new Dashboard();
$controller->addUser();
