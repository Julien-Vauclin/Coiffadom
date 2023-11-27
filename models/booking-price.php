<?php
class Booking
{
    private string $ID;
    private string $BOOKING_TYPE_ID;
    private string $HAIR_LENGTH_ID;
    private string $BOOKING_DURATION;
    private string $BOOKING_PRICE;
    // Fonction qui permet de voir les réservations
    public static function getAllBookings()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `booking`";
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

    // Fonction qui permet de créer une réservation
    public static function createBooking(
        string $BOOKING_DATE,
        string $BOOKING_TIME,
        string $BOOKING_DURATION,
        string $BOOKING_USER_ID,
        string $BOOKING_TYPE_ID,
        string $BOOKING_COST,
        string $HAIR_LENGTH_ID
    ) {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO `booking` (`BOOKING_DATE`, `BOOKING_TIME`, `BOOKING_DURATION`, `BOOKING_USER_ID`, `BOOKING_TYPE_ID`, `BOOKING_COST`, `HAIR_LENGTH_ID`)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$BOOKING_DATE, $BOOKING_TIME, $BOOKING_DURATION, $BOOKING_USER_ID, $BOOKING_TYPE_ID, $BOOKING_COST, $HAIR_LENGTH_ID]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Erreur lors de la récup";
            return false;
        }
    }

    // Fonction qui permet de modifier et de supprimer une réservation
    public static function updateBooking(string $BOOKING_TYPE_ID, string $HAIR_LENGTH_ID, string $BOOKING_DURATION, string $BOOKING_PRICE)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE `booking` SET `ID` = ?, `BOOKING_TYPE_ID` = ?, `HAIR_LENGTH_ID` = ?, `BOOKING_DURATION` = ?, `BOOKING_PRICE` = ? WHERE `ID` = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$BOOKING_TYPE_ID, $HAIR_LENGTH_ID, $BOOKING_DURATION, $BOOKING_PRICE]);
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
