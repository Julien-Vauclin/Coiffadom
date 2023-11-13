<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
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
    </div>
    <?php echo $hairstyleTypeError; ?>
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
    </div>
    <?php echo $hairstyleLengthError; ?>
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
    </div>
    <?php echo $hairstyleDateError; ?>
    <!-- Heure -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleTime">Heure</label>
        <input value="<?= isset($_POST['hairstyleTime']) ? $_POST['hairstyleTime'] : "" ?>" type="time" class="form-control" id="hairstyleTime" name="hairstyleTime">
    </div>
    <?php echo $hairstyleTimeError; ?>
    <div class="divBookingButtons">
        <a href="../../Coiffadom/controllers/controller-myaccount.php">
            <button type="button" class="returnToMyAccountButton">Retour</button>
        </a>
        <button class="newBookingButton" type="submit">Réserver</button>
    </div>
</form>
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
<!-- Confirmation de la réservation -->
<script>
    document.addEventListener("click", e => {
        if (e.target.classList.contains("newBookingButton")) {
            if (confirm("Êtes-vous sûr de vouloir réserver ?")) {
                alert("Votre réservation a bien été prise en compte !");
            } else {
                e.preventDefault();
            }
        }
    })
</script>
<?php require_once "components/footer.php" ?>