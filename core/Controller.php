<?php

abstract class Controller
{
    /**
     * Affiche une vue en l'enveloppant dans le layout (header/footer).
     *
     * @param string 
     * @param array  
     */
    protected function render(string $view, array $data = []): void
    {
     
        $categorieModel = new Categorie();
        $categories = $categorieModel->findAll();
        $categorieActive = $data['categorieActive'] ?? 0;
        $pageTitle = $data['pageTitle'] ?? '';

        extract($data);

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . "/../views/{$view}.php";
        require __DIR__ . '/../views/layout/footer.php';
    }
}
