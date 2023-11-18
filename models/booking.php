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
    // Voir toutes les reservations
    public static function getAllBookings()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT *
            FROM `booking` 
            INNER JOIN `user` ON `BOOKING_USER_ID` = `ID` 
            INNER JOIN `hair_length` ON `booking`.`HAIR_LENGTH_ID` = `hair_length`.`ID`
            INNER JOIN `booking_type` ON `booking`.`BOOKING_TYPE_ID` = `booking_type`.`ID`
            ORDER BY `BOOKING_ID` DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
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
    // Voir les réservations en fonction de l'utilisateur
    public static function getBookingByUser($id)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT *
            FROM `booking` 
            INNER JOIN `user` ON `BOOKING_USER_ID` = `ID` 
            INNER JOIN `hair_length` ON `booking`.`HAIR_LENGTH_ID` = `hair_length`.`ID`
            INNER JOIN `booking_type` ON `booking`.`BOOKING_TYPE_ID` = `booking_type`.`ID`
            WHERE `BOOKING_USER_ID` = ?
            ORDER BY `BOOKING_DATE`";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            if ($stmt->rowCount() > 0) {
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
    // Accepter reservation
    public static function acceptBooking($id)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE `booking` SET `BOOKING_STATUS_ID` = 2 WHERE `booking`.`BOOKING_ID` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Erreur lors de la récup";
            return false;
        }
    }
    // Refuser reservation
    public static function refuseBooking($id)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE `booking` SET `BOOKING_STATUS_ID` = 3 WHERE `booking`.`BOOKING_ID` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "Erreur lors de la récup";
            return false;
        }
    }
    // Annuler reservation
    public static function cancelBooking($id)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "DELETE FROM `booking` WHERE `BOOKING_ID` = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
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
