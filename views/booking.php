<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<div class="mb-3 bookingTypeDiv">
    <label for="BOOKING_TYPE_ID" class="form-label">Service de coiffure</label>
    <select class="form-select" id="BOOKING_TYPE_ID" name="BOOKING_TYPE_ID">
        <option value="" disabled selected>Choisir un service</option>
        <option value="1">Coupe + brushing</option>
        <option value="2">Balayage</option>
        <option value="3">Global</option>
        <option value="4">Coloration</option>
        <option value="5">Racines</option>
        <option value="6">Patine</option>
        <option value="7">Coiffage</option>
    </select>
</div>
<?php require_once "components/footer.php" ?>