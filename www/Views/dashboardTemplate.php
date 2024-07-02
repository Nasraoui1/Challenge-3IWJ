<!-- dashboardTemplate.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="/path/to/your/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="/dashboard">Overview</a></li>
                <li><a href="/dashboard/users">Utilisateurs</a></li>
                <li><a href="/dashboard/admins">Administrateurs</a></li>
                <li><a href="#pages">Pages</a></li>
            </ul>
        </nav>
    </aside>
    <main class="main-content">
        <header class="header">
            <h1>Tableau de bord</h1>
        </header>
        <section class="content">
            <?php include($content); ?>
        </section>
    </main>
</div>
</body>
<style>
    /* styles.css */
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
    }

    .dashboard-container {
        display: flex;
    }

    .sidebar {
        width: 250px;
        background-color: #2c3e50;
        color: #ecf0f1;
        height: 100vh;
        position: fixed;
    }

    .sidebar-header {
        padding: 20px;
        text-align: center;
        background-color: #1a252f;
    }

    .sidebar-header h2 {
        margin: 0;
    }

    .sidebar-nav ul {
        list-style: none;
        padding: 0;
    }

    .sidebar-nav ul li {
        margin: 20px 0;
    }

    .sidebar-nav ul li a {
        color: #ecf0f1;
        text-decoration: none;
        padding: 10px 20px;
        display: block;
    }

    .sidebar-nav ul li a:hover {
        background-color: #34495e;
    }

    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
    }

    .header {
        background-color: #ecf0f1;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .header h1 {
        margin: 0;
    }

    .overview {
        padding: 20px 0;
    }

    .card {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        margin-top: 0;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        .sidebar-nav ul li {
            display: inline;
        }

        .sidebar-nav ul li a {
            display: inline-block;
        }
    }
</style>
</html>
