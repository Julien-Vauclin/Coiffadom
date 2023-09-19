<?php
class Database
{
    // Méthode qui retourne une instance de la classe PDO
    public static function createInstancePDO(): object
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            return $pdo; // Retourne l'objet PDO créé
        } catch (PDOException $e) {
            throw new Exception('Erreur lors de la connexion à la base de données : ' . $e->getMessage());
        }
    }
}
