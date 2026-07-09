<?php
require_once __DIR__ . '/db.php';

// Récupération des catégories pour le menu dynamique
$stmtCategories = $pdo->query('SELECT id, libelle FROM Categorie ORDER BY libelle ASC');
$categories = $stmtCategories->fetchAll();

// Catégorie actuellement sélectionnée (0 = Accueil / toutes les catégories)
$categorieActive = isset($_GET['cat']) ? (int) $_GET['cat'] : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : '' ?>Actualités Polytechniciennes</title>
    <link rel="stylesheet" href="<?= isset($baseUrl) ? $baseUrl : '' ?>css/style.css">
</head>
<body>

<header class="site-header">
    <h1>Actualités Polytechniciennes</h1>
</header>

<nav class="site-nav">
    <ul>
        <li>
            <a href="<?= isset($baseUrl) ? $baseUrl : '' ?>index.php"
               class="<?= $categorieActive === 0 ? 'active' : '' ?>">Accueil</a>
        </li>
        <?php foreach ($categories as $cat): ?>
            <li>
                <a href="<?= isset($baseUrl) ? $baseUrl : '' ?>index.php?cat=<?= $cat['id'] ?>"
                   class="<?= $categorieActive === (int)$cat['id'] ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<main class="site-content">
