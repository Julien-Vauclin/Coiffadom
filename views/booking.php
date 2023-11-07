<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Service de coiffure -->
<form action="POST">
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
    <!-- Date -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleDate" class="form-label">Date</label>
        <input type="date" class="form-control" id="hairstyleDate" name="hairstyleDate">
    </div>
    <!-- Heure -->
    <div class="mb-3 bookingTypeDiv">
        <label for="hairstyleTime">Heure</label>
        <input type="time" class="form-control" id="hairstyleTime" name="hairstyleTime">
    </div>
</form>
<button type="submit">Réserver</button>
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
                        document.querySelector("#temps").innerHTML = `Temps estimé : ` + data.BOOKING_DURATION + `h`;
                        document.querySelector("#prix").innerHTML = `Coût estimé : ` + data.BOOKING_PRICE + `€`;
                        document.querySelector("#date").innerHTML = data.BOOKING_DATE;
                        document.querySelector("#heure").innerHTML = data.BOOKING_TIME;
                        console.log(data.BOOKING_DURATION)
                        console.log(data.BOOKING_PRICE)
                        console.log(data.BOOKING_DATE)
                        console.log(data.BOOKING_TIME)
                    })
            }
        };
    })
</script>
<p id="date"></p> <!-- BOOKING_DATE -->
<p id="heure"></p> <!-- BOOKING_TIME -->
<p id="temps"></p> <!-- BOOKING_DURATION -->
<?php echo $_SESSION['user']['ID'] ?> <!-- BOOKING_USER_ID -->
<p id="prix"></p> <!-- BOOKING_COST -->



<?php require_once "components/footer.php" ?>