<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) && $pageTitle !== '' ? htmlspecialchars($pageTitle) . ' - ' : '' ?>Actualités Polytechniciennes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <h1>Actualités Polytechniciennes</h1>
</header>

<nav class="site-nav">
    <ul>
        <li>
            <a href="index.php" class="<?= (int) $categorieActive === 0 ? 'active' : '' ?>">Accueil</a>
        </li>
        <?php foreach ($categories as $cat): ?>
            <li>
                <a href="index.php?cat=<?= $cat['id'] ?>"
                   class="<?= (int) $categorieActive === (int) $cat['id'] ? 'active' : '' ?>">
                    <?= htmlspecialchars($cat['libelle']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<main class="site-content">
