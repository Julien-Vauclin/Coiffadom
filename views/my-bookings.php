<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Boutons -->

<div class="divButtonsMyBookings">
    <a href="../../Coiffadom/controllers/controller-booking.php">
        <button id="sentButton" class="sentButton">Prendre RDV</button>
    </a>
    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['USER_ADMIN'] == 1)) {
        echo "<a href='../../Coiffadom/controllers/controller-admin-booking.php'>";
        echo "<button id='newMessageButton' class='newMessageButton'>Voir mes RDV</button>";
        echo "</a>";
    } else {
        echo "<a href='../../Coiffadom/controllers/controller-booking.php'>";
        echo "<button id='newMessageButton' class='newMessageButton'>Voir mes RDV</button>";
        echo "</a>";
    }
    ?>
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
                <?php
                if ($booking['BOOKING_TYPE_NAME'] == "COUPE_BRUSHING") {
                    $booking['BOOKING_TYPE_NAME'] = "Coupe + Brushing";
                }
                if ($booking['BOOKING_TYPE_NAME'] == "MECHES") {
                    $booking['BOOKING_TYPE_NAME'] = "Mèches";
                } ?>
                <td><?= ucfirst(strtolower($booking['BOOKING_TYPE_NAME'])) ?></td>
                <?php
                if ($booking['HAIR_LENGTH_NAME'] == "TRES_LONG") {
                    $booking['HAIR_LENGTH_NAME'] = "Très long";
                }
                ?>
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
                    echo "<button name='cancel' type='button' data-bs-toggle='modal' data-bs-target='#modalCancelBooking-{$booking['BOOKING_ID']}' value='{$booking['BOOKING_ID']}' class='btn btn-danger'>Annuler</button>";
                    echo "</td>";
                } else {
                    echo "<td></td>";
                }
                ?>
                <!-- Modal -->
                <div class="modal fade" id="modalCancelBooking-<?= $booking['BOOKING_ID'] ?>" tabindex="-1" aria-labelledby="modalCancelBookingLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalCancelBookingLabel">Annulation du RDV du <?= date('d/m/Y', strtotime($booking['BOOKING_DATE'])) ?>.</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr(e) de vouloir annuler ce RDV ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non, je n'annule pas</button>
                                <form id="cancelBookingForm" action="" method="POST">
                                    <button name="cancel" type="submit" value="<?= $booking['BOOKING_ID'] ?>" class="btn btn-danger">Oui, j'annule</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
    </tbody>
</table>
<!-- Annulation RDV -->

<?php require_once "components/footer.php" ?>