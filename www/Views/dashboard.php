<div class="overview">
    <h2>Overview</h2>
    <div class="card-container">
        <div class="card">
            <h3>Utilisateurs</h3>
            <p>Nombre d'utilisateurs : <?= isset($elementsCount['users']) ? $elementsCount['users'] : 'N/A' ?></p>
        </div>
        <div class="card">
            <h3>Administrateurs</h3>
            <p>Nombre d'administrateurs : <?= isset($elementsCount['admins']) ? $elementsCount['admins'] : 'N/A' ?></p>
        </div>
        <div class="card">
            <h3>Pages</h3>
            <p>Nombre de pages : <?= isset($elementsCount['pages']) ? $elementsCount['pages'] : 'N/A' ?></p>
        </div>
    </div>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .overview {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .overview h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: 700;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.3rem 2rem rgba(58, 59, 69, 0.2);
        }

        .card h3 {
            margin-top: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .card p {
            font-size: 1rem;
            color: #666;
            margin: 10px 0 0;
        }

    </style>
</div>
