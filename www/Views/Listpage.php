<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Pages</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
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

        .page-management .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 20px;
        }

        .page-management .btn:hover {
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
    <button class="btn" onclick="window.location.href='/create-page'">Ajouter une Page</button>
    <?php if (!empty($pages)): ?>
        <table class="page-table highlight responsive-table">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td data-label="Titre"><?= htmlspecialchars($page->getTitle()) ?></td>
                    <td data-label="Contenu"><?= htmlspecialchars($page->getContent()) ?></td>
                    <td data-label="Description"><?= htmlspecialchars($page->getDescription()) ?></td>
                    <td data-label="Actions">
                        <a href="/view-page/<?= $page->getSlug() ?>" class="btn blue">Voir</a>
                        <a href="/edit-page?id=<?= $page->getId() ?>" class="btn orange">Modifier</a>
                        <form method="post" action="/delete-page" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($page->getId()) ?>">
                            <button type="submit" class="btn red">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune page trouvée.</p>
    <?php endif; ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
