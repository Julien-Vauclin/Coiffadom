<?php
class Haircut
{
    private string $ID;
    private string $HAIRCUT_IMG_NAME;
    private string $HAIRCUT_IMG_DESCRIPTION;

    public static function getHaircuts()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM haircut";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $haircut = $stmt->fetchAll();
            return $haircut;
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération de la description : " . $exception->getMessage();
            return [];
        }
    }
    // Fonction pour insérer le nom de l'image dans la base de données
    public static function insertHaircut($filename)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO haircut (HAIRCUT_IMG_NAME) VALUES (:filename)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':filename', $filename, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $exception) {
            echo "Erreur lors de l'insertion de l'image : " . $exception->getMessage();
            return false;
        }
    }
}
