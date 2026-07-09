<?php
$baseUrl = '';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$categorieId = isset($_GET['cat']) ? (int) $_GET['cat'] : 0;

$titrePage = 'Les dernières actualités';

if ($categorieId > 0) {
    // Récupère le libellé de la catégorie pour le titre
    $stmtCat = $pdo->prepare('SELECT libelle FROM Categorie WHERE id = :id');
    $stmtCat->execute(['id' => $categorieId]);
    $cat = $stmtCat->fetch();

    if ($cat) {
        $titrePage = 'Actualités : ' . $cat['libelle'];
        $stmt = $pdo->prepare(
            'SELECT a.*, c.libelle AS categorie_libelle
             FROM Article a
             JOIN Categorie c ON a.categorie = c.id
             WHERE a.categorie = :cat
             ORDER BY a.dateCreation DESC'
        );
        $stmt->execute(['cat' => $categorieId]);
    } else {
        $categorieId = 0;
    }
}

if ($categorieId === 0) {
    $stmt = $pdo->query(
        'SELECT a.*, c.libelle AS categorie_libelle
         FROM Article a
         JOIN Categorie c ON a.categorie = c.id
         ORDER BY a.dateCreation DESC'
    );
}

$articles = $stmt->fetchAll();

$pageTitle = $titrePage;
require_once __DIR__ . '/includes/header.php';
?>

<h2 class="page-title"><?= htmlspecialchars($titrePage) ?></h2>

<div class="article-list">
    <?php if (empty($articles)): ?>
        <p class="no-articles">Aucun article disponible pour le moment.</p>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <article class="article-card">
                <span class="article-category"><?= htmlspecialchars($article['categorie_libelle']) ?></span>
                <h3><a href="article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['titre']) ?></a></h3>
                <p class="article-date"><?= formaterDate($article['dateCreation']) ?></p>
                <p class="article-excerpt"><?= htmlspecialchars(tronquer($article['contenu'], 250)) ?></p>
                <a class="read-more" href="article.php?id=<?= $article['id'] ?>">Lire la suite &rarr;</a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
