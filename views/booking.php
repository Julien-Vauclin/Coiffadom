<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Boutons -->
<div class="divButtonsMyBookings">
    <a href="../../Coiffadom/controllers/controller-booking.php">
        <button id="sentButton" class="sentButton">Prendre RDV</button>
    </a>
    <a href="../../Coiffadom/controllers/controller-my-bookings.php">
        <button id="newMessageButton" class="newMessageButton">Voir mes RDV</button>
    </a>
</div>
<!-- Service de coiffure -->
<form method="POST" action="">
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleType" class="form-label">Service de coiffure</label>
        <select class="form-select" id="hairstyleType" name="hairstyleType">
            <option value="" disabled selected>Choisir un service</option>
            <option value="1" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 1 ? "selected" : "" ?>>Coupe + brushing</option>
            <option value="2" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 2 ? "selected" : "" ?>>Balayage</option>
            <option value="3" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 3 ? "selected" : "" ?>>Mèches</option>
            <option value="4" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 4 ? "selected" : "" ?>>Coloration</option>
            <option value="5" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 5 ? "selected" : "" ?>>Racines</option>
            <option value="6" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 6 ? "selected" : "" ?>>Patine</option>
            <option value="7" <?= isset($_POST['hairstyleType']) && $_POST['hairstyleType'] == 7 ? "selected" : "" ?>>Coiffage</option>
        </select>
        <?php echo $hairstyleTypeError; ?>
    </div>
    <!-- Longueur de cheveux -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleLength" class="form-label">Longueur de cheveux</label>
        <select class="form-select" id="hairstyleLength" name="hairstyleLength">
            <option value="" disabled selected>Choisir une longueur</option>
            <option value="1" <?= isset($_POST['hairstyleLength']) && $_POST['hairstyleLength'] == 1 ? "selected" : "" ?>>Court</option>
            <option value="2" <?= isset($_POST['hairstyleLength']) && $_POST['hairstyleLength'] == 2 ? "selected" : "" ?>>Mi-long</option>
            <option value="3" <?= isset($_POST['hairstyleLength']) && $_POST['hairstyleLength'] == 3 ? "selected" : "" ?>>Long</option>
            <option value="4" <?= isset($_POST['hairstyleLength']) && $_POST['hairstyleLength'] == 4 ? "selected" : "" ?>>Très long</option>
        </select>
        <?php echo $hairstyleLengthError; ?>
    </div>
    <div class="mb-3 bookingTypeDiv" style="display: flex; justify-content: space-evenly;">
        <div>
            <input type="hidden" id="inputEstimatedPrice" name="inputEstimatedPrice">
            <label for="hairstylePrice">Prix estimé : </label><input value="<?= isset($_POST['inputEstimatedPrice']) ? $_POST['inputEstimatedPrice'] : "" ?>" style="background-color: transparent; border: none;" readonly id="prix" name="hairstylePrice">
        </div>
        <div>
            <input type="hidden" id="inputEstimatedDuration" name="inputEstimatedDuration">
            <label for="hairstyleDuration">Durée estimée : </label><input value="<?= isset($_POST['inputEstimatedDuration']) ? $_POST['inputEstimatedDuration'] : "" ?>" style="background-color: transparent; border: none;" readonly id="temps" name="hairstyleDuration">
        </div>
    </div>
    <!-- Date -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleDate" class="form-label">Date</label>
        <input value="<?= isset($_POST['hairstyleDate']) ? $_POST['hairstyleDate'] : "" ?>" type="date" class="form-control" id="hairstyleDate" name="hairstyleDate">
        <?php echo $hairstyleDateError; ?>
    </div>
    <!-- Heure -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleTime">Heure</label>
        <input value="<?= isset($_POST['hairstyleTime']) ? $_POST['hairstyleTime'] : "" ?>" type="time" class="form-control" id="hairstyleTime" name="hairstyleTime">
        <?php echo $hairstyleTimeError; ?>
    </div>
    <div class="divButtonsMyBookings">
        <a href="../../Coiffadom/controllers/controller-home.php">
            <button type="button" class="returnToMyAccountButton">Retour</button>
        </a>
        <!-- Bouton Réserver (MODAL) -->
        <button id="sentButton" class="sentButton">Réserver</button>

    </div>
    <!-- Script qui permet d'afficher le temps et le prix estimé en fonction du service de coiffure et de la longueur de cheveux -->
    <script>
        document.addEventListener("change", e => {
            if (e.target.classList.contains("form-select")) {
                let hairstyleType = document.querySelector("#hairstyleType").value;
                let hairstyleLength = document.querySelector("#hairstyleLength").value;
                if (hairstyleType != "" && hairstyleLength != "") {
                    fetch(`../controllers/ajax-price.php?hairstyleType=${hairstyleType}&hairstyleLength=${hairstyleLength}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            const heures = Math.floor(data.BOOKING_DURATION);
                            const minutes = Math.floor((data.BOOKING_DURATION - heures) * 60);
                            const heuresAffichees = heures < 10 ? heures : heures.toString();
                            const minutesAffichees = minutes === 0 ? '' : minutes < 10 ? `:0${minutes}` : `${minutes}`;
                            document.querySelector("#temps").value = `${heuresAffichees}h${minutesAffichees}`;
                            document.querySelector("#inputEstimatedDuration").value = `${heuresAffichees}h${minutesAffichees}`;
                            document.querySelector("#prix").value = data.BOOKING_PRICE + "€";
                            document.querySelector("#inputEstimatedPrice").value = data.BOOKING_PRICE + "€";
                        })
                }
            };
        })
    </script>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Validation du RDV.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr(e) de vouloir réserver ce rendez-vous ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                    <input type="submit" class="btn btn-primary" value="Valider" name="confirmBooking">
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
        keyboard: false
    });
</script>
<?php
if ($error === 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>myModal.show();</script>";
}
?>


<?php require_once "components/footer.php" ?>