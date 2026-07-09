<h2 class="page-title"><?= htmlspecialchars($titrePage) ?></h2>

<div class="article-list">
    <?php if (empty($articles)): ?>
        <p class="no-articles">Aucun article disponible pour le moment.</p>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <article class="article-card">
                <span class="article-category"><?= htmlspecialchars($article['categorie_libelle']) ?></span>
                <h3>
                    <a href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">
                        <?= htmlspecialchars($article['titre']) ?>
                    </a>
                </h3>
                <p class="article-date"><?= formaterDate($article['dateCreation']) ?></p>
                <p class="article-excerpt"><?= htmlspecialchars(tronquer($article['contenu'], 250)) ?></p>
                <a class="read-more" href="index.php?controller=article&action=show&id=<?= $article['id'] ?>">
                    Lire la suite &rarr;
                </a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
