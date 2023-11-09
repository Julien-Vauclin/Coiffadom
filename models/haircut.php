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
}
