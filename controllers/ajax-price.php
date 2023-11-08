<?php
require_once "../config.php";
require_once "../helpers/database.php";
if (isset($_GET['hairstyleType']) && isset($_GET['hairstyleLength'])) {
    $hairstyleType = $_GET['hairstyleType'];
    $hairstyleLength = $_GET['hairstyleLength'];
    $pdo = Database::createInstancePDO();
    $sql = "SELECT `BOOKING_DURATION`, `BOOKING_PRICE` FROM `booking_price` WHERE `BOOKING_TYPE_ID` = ? AND `HAIR_LENGHT_ID` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$hairstyleType, $hairstyleLength]);
    $result = $stmt->fetch();
    $encodedResult = json_encode($result);
    echo ($encodedResult);
} else {
    echo "Erreur lors de la récup";
}
