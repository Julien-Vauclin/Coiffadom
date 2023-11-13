<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>

<!-- view -->
<?php
$displayAllBookings = BookingAdmin::getAllBookings();
?>
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
        <?php foreach ($displayAllBookings as $booking) : ?>
            <tr>
                <td><?= $booking['USER_FIRSTNAME'] . " " . $booking['USER_LASTNAME'] ?></td>
                <td><?= date('d/m/Y', strtotime($booking['BOOKING_DATE'])) ?></td>
                <?php $bookingTime = new DateTime($booking['BOOKING_TIME']); ?>
                <td><?= $bookingTime->format('H\hi') ?></td>
                <td><?= ucfirst(strtolower($booking['BOOKING_TYPE_NAME'])) ?></td>
                <td><?= ucfirst(strtolower($booking['HAIR_LENGTH_NAME'])) ?></td>
                <td>
                    <form action="" method="POST">
                        <button name="accept" value="<?= $booking['BOOKING_ID'] ?>" class="btn btn-success">Accepter</button>
                        <button name="refuse" value="<?= $booking['BOOKING_ID'] ?>" class="btn btn-danger">Refuser</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>