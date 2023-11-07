<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Service de coiffure -->
<form method="POST" action="">
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleType" class="form-label">Service de coiffure</label>
        <select class="form-select" id="hairstyleType" name="hairstyleType">
            <option value="" disabled selected>Choisir un service</option>
            <option value="1">Coupe + brushing</option>
            <option value="2">Balayage</option>
            <option value="3">Mèches</option>
            <option value="4">Coloration</option>
            <option value="5">Racines</option>
            <option value="6">Patine</option>
            <option value="7">Coiffage</option>
        </select>
    </div>
    <?php echo $hairstyleTypeError; ?>
    <!-- Longueur de cheveux -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleLength" class="form-label">Longueur de cheveux</label>
        <select class="form-select" id="hairstyleLength" name="hairstyleLength">
            <option value="" disabled selected>Choisir une longueur</option>
            <option value="1">Court</option>
            <option value="2">Mi-long</option>
            <option value="3">Long</option>
            <option value="4">Très long</option>
        </select>
    </div>
    <?php echo $hairstyleLengthError; ?>
    <!-- Date -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleDate" class="form-label">Date</label>
        <input type="date" class="form-control" id="hairstyleDate" name="hairstyleDate">
    </div>
    <?php echo $hairstyleDateError; ?>
    <!-- Heure -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleTime">Heure</label>
        <input type="time" class="form-control" id="hairstyleTime" name="hairstyleTime">
    </div>
    <?php echo $hairstyleTimeError; ?>
    <label for="hairstylePrice">Prix : </label><input readonly id="prix" name="hairstylePrice">
    <label for="hairstyleDuration">Heure : </label><input readonly id="temps" name="hairstyleDuration">
    <button type="submit">Réserver</button>
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
                        document.querySelector("#temps").value = data.BOOKING_DURATION;
                        document.querySelector("#prix").value = data.BOOKING_PRICE;
                    })
            }
        };
    })
</script>

<?php require_once "components/footer.php" ?>