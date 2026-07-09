<?php

class ArticleController extends Controller
{
    private Article $articleModel;
    private Categorie $categorieModel;

    public function __construct()
    {
        $this->articleModel = new Article();
        $this->categorieModel = new Categorie();
    }

    public function index(): void
    {
        $categorieId = isset($_GET['cat']) ? (int) $_GET['cat'] : 0;
        $titrePage = 'Les dernieres actualites';

        if ($categorieId > 0) {
            $categorie = $this->categorieModel->find($categorieId);
            if ($categorie) {
                $titrePage = 'Actualites : ' . $categorie['libelle'];
            } else {
              
                $categorieId = 0;
            }
        }

        $articles = $this->articleModel->findAll($categorieId ?: null);

        $this->render('article/index', [
            'articles' => $articles,
            'titrePage' => $titrePage,
            'pageTitle' => $titrePage,
            'categorieActive' => $categorieId,
        ]);
    }


    public function show(): void
    {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $article = $this->articleModel->find($id);

        if (!$article) {
            header('Location: index.php');
            exit;
        }

        $this->render('article/show', [
            'article' => $article,
            'pageTitle' => $article['titre'],
            'categorieActive' => (int) $article['categorie'],
        ]);
    }
}
