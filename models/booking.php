<?php
class Booking
{
    private string $ID_BOOKING;
    private string $DATE_BOOKING;
    private string $TIME_BOOKING;
    private string $DURATION_BOOKING;
    private string $TYPE_BOOKING;
    // Fonction qui permet de voir les réservations
    public static function getAllBookings(string $ID_BOOKING)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM `booking` WHERE `ID_BOOKING` = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$ID_BOOKING]);
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
    public static function createBooking(string $DATE_BOOKING, string $TIME_BOOKING, string $DURATION_BOOKING, string $TYPE_BOOKING)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "INSERT INTO `booking` (`DATE_BOOKING`, `TIME_BOOKING`, `DURATION_BOOKING`, `TYPE_BOOKING`) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$DATE_BOOKING, $TIME_BOOKING, $DURATION_BOOKING, $TYPE_BOOKING]);
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
    public static function updateBooking(string $ID_BOOKING, string $DATE_BOOKING, string $TIME_BOOKING, string $DURATION_BOOKING, string $TYPE_BOOKING)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE `booking` SET `DATE_BOOKING` = ?, `TIME_BOOKING` = ?, `DURATION_BOOKING` = ?, `TYPE_BOOKING` = ? WHERE `ID_BOOKING` = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$DATE_BOOKING, $TIME_BOOKING, $DURATION_BOOKING, $TYPE_BOOKING, $ID_BOOKING]);
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
