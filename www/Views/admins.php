<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .admin-management {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 20px;
        }

        .admin-management h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th, .admin-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .admin-table th {
            background-color: #f4f4f4;
            font-weight: 700;
        }

        .admin-table td button {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-right: 5px;
        }

        .admin-table td button:hover {
            background-color: #5a6268;
        }

        .admin-table td form {
            display: inline-block;
        }

        @media (max-width: 768px) {
            .admin-table th, .admin-table td {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .admin-table th, .admin-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .admin-table td {
                border: none;
                border-bottom: 1px solid #ddd;
                padding-left: 50%;
                position: relative;
            }

            .admin-table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: calc(50% - 20px);
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: 700;
            }
        }
    </style>
</head>
<body>

<div class="admin-management">
    <h2>Administrateurs</h2>
    <table class="admin-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td data-label="ID"><?= htmlspecialchars($admin['id']) ?></td>
                <td data-label="Prénom"><?= htmlspecialchars($admin['firstname']) ?></td>
                <td data-label="Nom"><?= htmlspecialchars($admin['lastname']) ?></td>
                <td data-label="Email"><?= htmlspecialchars($admin['email']) ?></td>
                <td data-label="Actions">
                    <form method="post" action="/dashboard/updateUserForm">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($admin['id']) ?>">
                        <button type="submit">Update</button>
                    </form>
                    <form method="post" action="/dashboard/deleteUser" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($admin['id']) ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
