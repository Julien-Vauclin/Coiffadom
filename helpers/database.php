<?php
class Database
{
    // Méthode qui retourne une instance de la classe PDO
    public static function createInstancePDO(): object
    {
        // Création d'une connexion à la base de données
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            // Création d'une instance de la classe PDO
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            // Retourne l'objet PDO créé
            return $pdo;
        } catch (PDOException $e) {
            // En cas d'erreur, on lance une exception
            throw new Exception('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
        }
    }
}
