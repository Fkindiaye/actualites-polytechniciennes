<?php

class Article
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

   
    public function findAll(?int $categorieId = null): array
    {
        if ($categorieId) {
            $stmt = $this->db->prepare(
                'SELECT a.*, c.libelle AS categorie_libelle
                 FROM Article a
                 JOIN Categorie c ON a.categorie = c.id
                 WHERE a.categorie = :cat
                 ORDER BY a.dateCreation DESC'
            );
            $stmt->execute(['cat' => $categorieId]);
        } else {
            $stmt = $this->db->query(
                'SELECT a.*, c.libelle AS categorie_libelle
                 FROM Article a
                 JOIN Categorie c ON a.categorie = c.id
                 ORDER BY a.dateCreation DESC'
            );
        }

        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT a.*, c.libelle AS categorie_libelle
             FROM Article a
             JOIN Categorie c ON a.categorie = c.id
             WHERE a.id = :id'
        );
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }
}
