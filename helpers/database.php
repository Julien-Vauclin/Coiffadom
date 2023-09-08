<!-- Base de données -->

<?php
class Database
{
    // Méthode qui retourne une instance de la classe PDO
    public static function createInstancePDO(): object
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            if ($pdo) {
                return $pdo;
            }
            return $pdo;
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}
