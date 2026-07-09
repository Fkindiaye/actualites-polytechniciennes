# Actualités Polytechniciennes

Site d'actualités développé en **PHP / MySQL / HTML / CSS**, avec un menu de catégories généré dynamiquement depuis la base de données.

## Fonctionnalités

- Liste des articles les plus récents sur la page d'accueil
- Menu dynamique construit à partir de la table `Categorie`
- Filtrage des articles par catégorie (`index.php?cat=ID`)
- Page de détail pour chaque article (`article.php?id=ID`)
- Design responsive inspiré de la maquette fournie

## Structure du projet

```
.
├── article.php          # Page de détail d'un article
├── index.php             # Page d'accueil (liste + filtre par catégorie)
├── mglsi_news.sql        # Script de création de la base de données
├── css/
│   └── style.css         # Feuille de style
├── includes/
│   ├── db.php             # Connexion PDO à la base de données
│   ├── functions.php      # Fonctions utilitaires (troncature, dates...)
│   ├── header.php         # En-tête + menu dynamique
│   └── footer.php         # Pied de page
└── img/                   # Dossier pour d'éventuelles images
```

## Installation

1. Cloner le dépôt :
   ```bash
   git clone <url-du-depot>
   cd <nom-du-depot>
   ```

2. Créer la base de données en important le script SQL fourni :
   ```bash
   mysql -u root -p < mglsi_news.sql
   ```
   Ce script crée la base `mglsi_news`, les tables `Article` et `Categorie`,
   insère des données de test, et crée l'utilisateur `mglsi_user` (mot de passe `passer`).

3. Vérifier les identifiants de connexion dans `includes/db.php` si besoin
   (hôte, nom de la base, utilisateur, mot de passe).

4. Lancer un serveur PHP local depuis le dossier du projet :
   ```bash
   php -S localhost:8000
   ```

5. Ouvrir [http://localhost:8000](http://localhost:8000) dans le navigateur.

## Base de données

- **Article** : `id`, `titre`, `contenu`, `dateCreation`, `dateModification`, `categorie` (clé étrangère vers `Categorie`)
- **Categorie** : `id`, `libelle`

## À venir

- Espace d'administration pour créer/modifier/supprimer des articles
- Pagination des articles
- Recherche par mot-clé

## Version

**v1.0** — Version initiale : affichage public des articles avec menu dynamique par catégorie.
