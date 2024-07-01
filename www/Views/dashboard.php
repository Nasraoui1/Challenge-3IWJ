<!-- dashboard.php -->
<div class="overview">
    <h2>Overview</h2>
    <div class="card">
        <h3>Utilisateurs</h3>
        <p>Nombre d'utilisateurs : <?= isset($elementsCount['users']) ? $elementsCount['users'] : 'N/A' ?></p>
    </div>
    <div class="card">
        <h3>Administrateurs</h3>
        <p>Nombre d'administrateurs : <?= isset($elementsCount['admin']) ? $elementsCount['admin'] : 'N/A' ?></p>
    </div>
    <div class="card">
        <h3>Pages</h3>
        <p>Nombre de pages : <?= isset($elementsCount['pages']) ? $elementsCount['pages'] : 'N/A' ?></p>
    </div>
</div>
