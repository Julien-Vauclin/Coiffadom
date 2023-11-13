<?php
class BookingAdmin
{
    private string $BOOKING_ID;
    private string $BOOKING_DATE;
    private string $BOOKING_TIME;
    private string $BOOKING_DURATION;
    private string $BOOKING_USER_ID;
    private string $BOOKING_TYPE_ID;
    private string $BOOKING_COST;
    private string $HAIR_LENGTH_ID;
    private string $BOOKING_STATUS_ID;
    // Fonction qui permet de voir les réservations
    public static function getAllBookings()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT *
            FROM `booking` 
            INNER JOIN `user` ON `BOOKING_USER_ID` = `ID` 
            INNER JOIN `hair_length` ON `booking`.`HAIR_LENGTH_ID` = `hair_length`.`ID`";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            // On vérifie s'il y'a des résultats    
            if ($stmt->rowCount() > 0) {
                // On retourne les résultats sous forme de tableau
                return $stmt->fetchAll();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Erreur lors de la récup";
            return false;
        }
    }
}
