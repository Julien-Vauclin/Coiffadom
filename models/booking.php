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
    // Voir reservations
    public static function getAllBookings()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT *
            FROM `booking` 
            INNER JOIN `user` ON `BOOKING_USER_ID` = `ID` 
            INNER JOIN `hair_length` ON `booking`.`HAIR_LENGTH_ID` = `hair_length`.`ID`
            INNER JOIN `booking_type` ON `booking`.`BOOKING_TYPE_ID` = `booking_type`.`ID`";
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
}
