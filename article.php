<?php
$baseUrl = '';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare(
    'SELECT a.*, c.libelle AS categorie_libelle
     FROM Article a
     JOIN Categorie c ON a.categorie = c.id
     WHERE a.id = :id'
);
$stmt->execute(['id' => $id]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: index.php');
    exit;
}

$pageTitle = $article['titre'];
require_once __DIR__ . '/includes/header.php';
?>

<article class="article-full">
    <span class="article-category"><?= htmlspecialchars($article['categorie_libelle']) ?></span>
    <h2><?= htmlspecialchars($article['titre']) ?></h2>
    <p class="article-date">Publié le <?= formaterDate($article['dateCreation']) ?></p>
    <div class="article-body">
        <?= nl2br(htmlspecialchars($article['contenu'])) ?>
    </div>
    <a class="back-link" href="index.php">&larr; Retour aux actualités</a>
</article>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
