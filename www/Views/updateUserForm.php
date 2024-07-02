<?php
global $bdd;
$page_titre = "Update User";
require("../config.php");

// Assuming $user variable is set
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .update-user-form {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            margin: auto;
            background-color: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .update-user-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 1rem;
            width: 100%;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            text-align: left;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.35rem;
            color: #333;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .text-center {
            text-align: center;
            margin-top: 1rem;
            width: 100%;
        }

        .text-center a {
            color: #007bff;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="update-user-form">
    <h2>Update User</h2>

    <?php if (isset($error_message) && $error_message): ?>
        <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <form method="POST" action="/dashboard/updateUser">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" placeholder="Enter first name" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>" placeholder="Enter last name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="id_role">Role</label>
            <select id="id_role" name="id_role" required>
                <option value="0" <?= $user['id_role'] == 0 ? 'selected' : '' ?>>User</option>
                <option value="1" <?= $user['id_role'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update User</button>
    </form>
</div>
</body>
</html>
