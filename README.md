# Actualités Polytechniciennes

Site d'actualités développé en **PHP / MySQL / HTML / CSS**, structuré selon le patron d'architecture **MVC** (Modèle - Vue - Contrôleur).

## Versions

- **v1.0** : version initiale, code procédural (pas de séparation MVC).
- **v2.0** : refactoring complet en MVC, avec front controller, modèles, contrôleurs et vues séparés.

## Architecture MVC

Conformément au cours (séparation stricte des responsabilités) :

- **Modèle** (`models/`) : représente et manipule les données. C'est la **seule** couche qui exécute des requêtes SQL (via `core/Database.php`). Il ne connaît ni la vue, ni le contrôleur.
- **Vue** (`views/`) : affiche les données transmises par le contrôleur. Elle n'effectue aucun traitement métier et ne fait aucune requête SQL.
- **Contrôleur** (`controllers/`) : intercepte les requêtes de l'utilisateur, appelle le(s) modèle(s), puis redirige vers la vue adéquate (méthode `render()`). Il ne fait aucun traitement métier ni requête SQL directe.

Toutes les requêtes passent par un **front controller** unique (`index.php`), qui route vers le bon contrôleur/action selon les paramètres `?controller=...&action=...`.

```
Navigateur → index.php (front controller) → Contrôleur → Modèle → Base de données
                                                 ↓
                                               Vue (layout + template) → Navigateur
```

## Structure du projet

```
.
├── index.php                    # Front controller : point d'entrée unique, routage
├── config/
│   └── config.php                # Paramètres de connexion à la base de données
├── core/
│   ├── Database.php               # Connexion PDO centralisée (singleton)
│   ├── Controller.php             # Classe de base : gère le rendu des vues
│   └── helpers.php                # Fonctions utilitaires pour les vues (dates, troncature)
├── models/
│   ├── Article.php                 # Toutes les requêtes SQL liées aux articles
│   └── Categorie.php               # Toutes les requêtes SQL liées aux catégories
├── controllers/
│   └── ArticleController.php       # index() : liste/filtre ; show() : détail d'un article
├── views/
│   ├── layout/
│   │   ├── header.php               # En-tête HTML + menu dynamique
│   │   └── footer.php               # Pied de page HTML
│   └── article/
│       ├── index.php                 # Template liste des articles
│       └── show.php                  # Template détail d'un article
├── css/
│   └── style.css
└── mglsi_news.sql                # Script de création de la base de données
```

## Routes disponibles

| URL | Contrôleur / Action | Description |
|---|---|---|
| `index.php` | `ArticleController::index()` | Liste des derniers articles |
| `index.php?cat=2` | `ArticleController::index()` | Liste filtrée par catégorie |
| `index.php?controller=article&action=show&id=3` | `ArticleController::show()` | Détail d'un article |

## Installation

1. Cloner le dépôt :
   ```bash
   git clone <url-du-depot>
   cd <nom-du-depot>
   ```

2. Créer la base de données en important le script SQL fourni :
   ```bash
   mysql -u root < mglsi_news.sql
   ```

3. Vérifier les identifiants de connexion dans `config/config.php` si besoin.

4. Lancer un serveur PHP local depuis le dossier du projet :
   ```bash
   php -S localhost:8000
   ```
   (ou placer le dossier dans `htdocs/` avec XAMPP)

5. Ouvrir [http://localhost:8000](http://localhost:8000) (ou `http://localhost/nom-du-dossier/` avec XAMPP).

## Base de données

- **Article** : `id`, `titre`, `contenu`, `dateCreation`, `dateModification`, `categorie` (clé étrangère vers `Categorie`)
- **Categorie** : `id`, `libelle`

## À venir

- Espace d'administration (CRUD articles) avec son propre contrôleur/modèle
- Pagination des articles
- Recherche par mot-clé
- Pattern DAO pour découpler davantage modèles et accès aux données
