<article class="article-full">
    <span class="article-category"><?= htmlspecialchars($article['categorie_libelle']) ?></span>
    <h2><?= htmlspecialchars($article['titre']) ?></h2>
    <p class="article-date">Publié le <?= formaterDate($article['dateCreation']) ?></p>
    <div class="article-body">
        <?= nl2br(htmlspecialchars($article['contenu'])) ?>
    </div>
    <a class="back-link" href="index.php">&larr; Retour aux actualites</a>
</article>
