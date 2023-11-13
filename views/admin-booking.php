<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- view -->
<p>vue admin booking</p>
<?php
$TEST111 = BookingAdmin::getAllBookings();
var_dump($TEST111);
?>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>