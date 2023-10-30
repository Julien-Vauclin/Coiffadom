<?php
class Booking
{
    private string $BOOKING_ID;
    private string $BOOKING_DATE;
    private string $BOOKING_TIME;
    private string $BOOKING_DURATION;
    private string $BOOKING_USER_ID;
    private string $BOOKING_TYPE_ID;
    private string $BOOKING_STATUS_ID;
    // Fonction qui permet de voir les réservations
    public static function getAllBookings(string $BOOKING_ID)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `booking` WHERE `BOOKING_ID` = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$BOOKING_ID]);
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
    public static function createBooking(string $BOOKING_DATE, string $BOOKING_TIME, string $BOOKING_DURATION, string $BOOKING_USER_ID, string $BOOKING_TYPE_ID, string $BOOKING_STATUS_ID)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO `booking` (`BOOKING_ID`, `BOOKING_DATE`, `BOOKING_TIME`, `BOOKING_DURATION`, `BOOKING_USER_ID`, `BOOKING_TYPE_ID`, `BOOKING_STATUS_ID`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$BOOKING_DATE, $BOOKING_TIME, $BOOKING_DURATION, $BOOKING_USER_ID, $BOOKING_TYPE_ID, $BOOKING_STATUS_ID]);
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
    // Fonction qui permet de modifier et de supprimer une réservation
    public static function updateBooking(string $BOOKING_ID, string $BOOKING_DATE, string $BOOKING_TIME, string $BOOKING_DURATION, string $BOOKING_USER_ID, string $BOOKING_TYPE_ID, string $BOOKING_STATUS_ID)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE `booking` SET `BOOKING_ID` = ?, `BOOKING_DATE` = ?, `BOOKING_TIME` = ?, `BOOKING_DURATION` = ?, `BOOKING_USER_ID` = ?, `BOOKING_TYPE_ID` = ?, `BOOKING_STATUS_ID` = ? WHERE `BOOKING_ID` = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$BOOKING_DATE, $BOOKING_TIME, $BOOKING_DURATION, $BOOKING_ID, $BOOKING_USER_ID, $BOOKING_TYPE_ID, $BOOKING_STATUS_ID]);
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
