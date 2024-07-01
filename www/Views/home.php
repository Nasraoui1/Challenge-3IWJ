<?php
// Set the title and content
$title = "Bienvenue sur Mindzone";
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
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
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
