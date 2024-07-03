<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Pages</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .page-management {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 20px;
        }

        .page-management h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .page-management .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 20px;
        }

        .page-management .btn-primary:hover {
            background-color: #0056b3;
        }

        .page-table {
            width: 100%;
            border-collapse: collapse;
        }

        .page-table th, .page-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .page-table th {
            background-color: #f4f4f4;
            font-weight: 700;
        }

        .page-table td button {
            background-color: #6c757d;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-right: 5px;
        }

        .page-table td button:hover {
            background-color: #5a6268;
        }

        .page-table td form {
            display: inline-block;
        }

        @media (max-width: 768px) {
            .page-table th, .page-table td {
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .page-table th, .page-table td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }

            .page-table td {
                border: none;
                border-bottom: 1px solid #ddd;
                padding-left: 50%;
                position: relative;
            }

            .page-table td::before {
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

<div class="page-management">
    <h2>Liste des Pages</h2>
    <button class="btn-primary" onclick="window.location.href='/dashboard/add-page'">Add Page</button>
    <table class="page-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pages as $page): ?>
            <tr>
                <td data-label="ID"><?= htmlspecialchars($page['id']) ?></td>
                <td data-label="Title"><?= htmlspecialchars($page['title']) ?></td>
                <td data-label="Description"><?= htmlspecialchars($page['description']) ?></td>
                <td data-label="Actions">
                    <form method="post" action="/dashboard/updatePageForm">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($page['id']) ?>">
                        <button type="submit">Update</button>
                    </form>
                    <form method="post" action="/dashboard/deletePage" onsubmit="return confirm('Are you sure you want to delete this page?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($page['id']) ?>">
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
