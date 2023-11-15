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
<!-- vue -->
<table class="table tableAdminBooking">
    <thead>
        <tr>
            <th scope="col">Date prévue</th>
            <th scope="col">Heure prévue</th>
            <th scope="col">Prestation demandée</th>
            <th scope="col">Longueur des cheveux</th>
            <th scope="col">Statut du RDV</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($displayBookingsByUserId as $booking) : ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($booking['BOOKING_DATE'])) ?></td>
                <?php $bookingTime = new DateTime($booking['BOOKING_TIME']); ?>
                <td><?= $bookingTime->format('H\hi') ?></td>
                <td><?= ucfirst(strtolower($booking['BOOKING_TYPE_NAME'])) ?></td>
                <td><?= ucfirst(strtolower($booking['HAIR_LENGTH_NAME'])) ?></td>
                <?php
                if ($booking['BOOKING_STATUS_ID'] == 1) {
                    $booking['BOOKING_STATUS_ID'] = "En attente ...";
                } elseif ($booking['BOOKING_STATUS_ID'] == 2) {
                    $booking['BOOKING_STATUS_ID'] = "<div class='text-success'>Validé</div>";
                } else {
                    $booking['BOOKING_STATUS_ID'] = "<div class='invalid'>Refusé</div>";
                }
                ?>
                <td><?= $booking['BOOKING_STATUS_ID'] ?></td>
                <!-- On affiche le bouton "Annuler" uniquement si le statut du RDV est "En attente" -->
                <?php if ($booking['BOOKING_STATUS_ID'] == "En attente ...") {
                    echo "<td>";
                    echo "<form action='' method='POST'>";
                    echo "<button name='cancel' type='submit' value='{$booking['BOOKING_ID']}' class='btn btn-danger' onclick='cancelBooking()'>Annuler</button>";
                    echo  "</form>";
                    echo "</td>";
                } else {
                    echo "<td></td>";
                }
                ?>
            <?php endforeach; ?>
    </tbody>
</table>
<!-- Annulation RDV -->
<script>
    function cancelBooking() {
        if (confirm("Voulez-vous vraiment annuler ce RDV ?")) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controller-my-bookings.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send();
        }
    }
</script>
<?php require_once "components/footer.php" ?>