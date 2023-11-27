<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>

<?php $displayAllBookings = BookingAdmin::getAllBookings(); ?>

<!-- Tableau permettant de voir tous les RDV en attente de validation -->
<table class="table tableAdminBooking">
    <thead>
        <tr>
            <th scope="col">Client</th>
            <th scope="col">Date prévue</th>
            <th scope="col">Heure prévue</th>
            <th scope="col">Prestation demandée</th>
            <th scope="col">Longueur des cheveux</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($displayAllBookings) < 1) {
            echo "<tr>";
            echo "<td colspan='6'>Vous n'avez pas encore de RDV.</td>";
            echo "</tr>";
        } else {
            foreach ($displayAllBookings as $booking) : ?>
                <tr>
                    <!-- Nom et prénom de l'utilisateur -->
                    <td><?= $booking['USER_FIRSTNAME'] . " " . $booking['USER_LASTNAME'] ?></td>
                    <!-- Date -->
                    <td><?= date('d/m/Y', strtotime($booking['BOOKING_DATE'])) ?></td>
                    <!-- Remise de l'heure au bon format -->
                    <?php $bookingTime = new DateTime($booking['BOOKING_TIME']); ?>
                    <!-- Heure -->
                    <td><?= $bookingTime->format('H\hi') ?></td>
                    <?php
                    if ($booking['BOOKING_TYPE_NAME'] == "COUPE_BRUSHING") {
                        $booking['BOOKING_TYPE_NAME'] = "Coupe + Brushing";
                    }
                    if ($booking['BOOKING_TYPE_NAME'] == "MECHES") {
                        $booking['BOOKING_TYPE_NAME'] = "Mèches";
                    } ?>
                    <!-- Prestation demandée -->
                    <td><?= ucfirst(strtolower($booking['BOOKING_TYPE_NAME'])) ?></td>
                    <?php
                    if ($booking['HAIR_LENGTH_NAME'] == "TRES_LONG") {
                        $booking['HAIR_LENGTH_NAME'] = "Très long";
                    }
                    ?>
                    <!-- Longueur des cheveux -->
                    <td><?= ucfirst(strtolower($booking['HAIR_LENGTH_NAME'])) ?></td>
                    <!-- Boutons "Accepter" et "Refuser" -->
                    <td>
                        <form action="" method="POST">
                            <button name="accept" value="<?= $booking['BOOKING_ID'] ?>" class="btn btn-success" onclick="acceptBooking()">Accepter</button>
                            <button name="refuse" value="<?= $booking['BOOKING_ID'] ?>" class="btn btn-danger" onclick="refuseBooking()">Refuser</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } ?>
    </tbody>
</table>
<!-- Accepter RDV -->
<script>
    function acceptBooking(bookingId) {
        if (confirm("Voulez-vous vraiment accepter ce rendez-vous ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller-accept-booking.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send('bookingId=' + bookingId);
        }
    }
</script>
<!-- Refuser RDV -->
<script>
    function refuseBooking(bookingId) {
        if (confirm("Voulez-vous vraiment refuser ce rendez-vous ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller-refuse-booking.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send('bookingId=' + bookingId);
        }
    }
</script>
<!-- Require -->
<?php require_once "components/footer.php" ?>