<?php
// Set the title and content
$title = "Bienvenue";
$content = "<h3>Les projets de nos utilisateurs</h3>";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="../Views/style.css"> <!-- Adjust the path as needed -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .header-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .nav {
            margin-top: 10px;
        }

        .nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .nav a.btn-primary {
            background-color: #0069d9;
        }

        .nav a.btn-primary:hover {
            background-color: #0056b3;
        }

        .nav a.btn-secondary {
            background-color: #6c757d;
        }

        .nav a.btn-secondary:hover {
            background-color: #5a6268;
        }

        .nav a.btn-danger {
            background-color: #dc3545;
        }

        .nav a.btn-danger:hover {
            background-color: #c82333;
        }

        .main-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            text-align: center;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
<header class="header">
    <div class="container">
        <h1 class="header-title">
            <?php
            if (isset($title)) {
                echo $title;
            } else {
                echo "Bienvenue sur la page d'accueil";
            }
            ?>
        </h1>
        <nav class="nav">
            <a href="login" class="btn btn-primary">Login</a>
            <a href="register" class="btn btn-secondary">Register</a>
            <a href="logout" class="btn btn-danger">Logout</a>
        </nav>
    </div>
</header>

<main class="main-content container">
    <?php
    if (isset($content)) {
        echo $content;
    } else {
        echo "<h3>Les projets de nos utilisateurs</h3>";
    }
    ?>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 . Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>
