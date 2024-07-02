<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="/Views/styles/dist/styles.css">
</head>
<body>
    <div class="profile-container">
        <section class="user-profile">
            <img src="<?= !empty($userData['img_path']) ? htmlspecialchars($userData['img_path']) : '/Views/styles/dist/images/profil.png' ?>" alt="Image de profil">
            <div class="user-info">
                <p class="subtitle"><?= htmlspecialchars($userData['firstname']) . ' user.php' . htmlspecialchars($userData['lastname']) ?></p>
                <p class="text"><strong>Email :</strong> <?= htmlspecialchars($userData['email']) ?></p>
                <p class="text"><strong>Nom d'utilisateur :</strong> <?= htmlspecialchars($userData['username']) ?></p>
                <p class="text"><strong>Status :</strong> <?= $userData['status'] === 0 ? 'Inactif' : 'Actif' ?></p>
                <p class="text"><strong>Rôle :</strong> <?= htmlspecialchars($userData['roles'] ?? 'Utilisateur') ?></p>
                <p class="text"><strong>Créé le :</strong> <?= date('d/m/Y à H:i', strtotime($userData['createdat'])) ?></p>
                <p class="text"><strong>Dernière mise à jour :</strong> <?= $userData['updatedat'] ? date('d/m/Y à H:i', strtotime($userData['updatedat'])) : 'N/A' ?></p>
                <p class="text"><strong>Actif :</strong> <?= $userData['is_active'] ? 'Oui' : 'Non' ?></p>
                <a href="/bo/user/edit-user?id=<?= $userData['id']; ?>"><button class="button button-primary">Modifier</button></a>
            </div>
        </section>
    </div>
</body>
<style>/* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.profile-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

.user-profile {
    display: flex;
    align-items: center;
}

.user-profile img {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-right: 20px;
}

.user-info {
    flex: 1;
}

.user-info .subtitle {
    font-size: 1.5em;
    color: #333;
    margin-bottom: 10px;
}

.user-info .text {
    font-size: 1.1em;
    color: #666;
    margin-bottom: 8px;
}

.user-info .button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1em;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.user-info .button:hover {
    background-color: #0056b3;
}
</style>
</html>
