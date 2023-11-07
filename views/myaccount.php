<?php session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../Coiffadom/controllers/controller-login.php");
    exit;
} ?>
<?php require_once "components/head.php" ?>
<?php require_once "components/navbar.php" ?>
<!-- Cards -->
<div class="container containerMyAccount">
    <div class="row upperRowMyAccount">
        <!-- Card 1 -->
        <div class="col-md-6 colMyAccount">
            <a href="../../Coiffadom/controllers/controller-mymessages.php">
                <div class="card cardMyAccount">
                    <img src="../../Coiffadom/assets/img/message.png" class="card-img-top logoMyAccount" alt="Logo messagerie">
                    <div class="card-body textCardMyAccount">
                        <h5 class="card-title">Messagerie</h5>
                        <p class="card-text">Envoyez et consultez vos messages</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2 -->
        <div class="col-md-6 colMyAccount">
            <a href="../../Coiffadom/controllers/controller-booking.php">
                <div class="card cardMyAccount">
                    <img src="../../Coiffadom/assets/img/appointment.png" class="card-img-top logoMyAccount" alt="Logo rendez-vous">
                    <div class="card-body textCardMyAccount">
                        <h5 class="card-title">Rendez-vous</h5>
                        <p class="card-text">Prenez, annulez ou modifiez vos rendez-vous</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row lowerRowMyAccount">
        <!-- Card 3 -->
        <div class="col-md-6 colMyAccount">
            <a href="../../Coiffadom/controllers/controller-payment.php">
                <div class="card cardMyAccount">
                    <img src="../../Coiffadom/assets/img/creditcard.png" class="card-img-top logoMyAccount" alt="Logo paiements">
                    <div class="card-body textCardMyAccount">
                        <h5 class="card-title">Moyens de paiement</h5>
                        <p class="card-text">Ajoutez ou supprimez vos moyens de paiements</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 4 -->
        <div class="col-md-6 colMyAccount">
            <a href="../../Coiffadom/controllers/controller-security.php">
                <div class="card cardMyAccount">
                    <img src="../../Coiffadom/assets/img/security.png" class="card-img-top logoMyAccount" alt="Logo connexion & sécurité">
                    <div class="card-body textCardMyAccount">
                        <h5 class="card-title">Connexion & Sécurité</h5>
                        <p class="card-text">Modifiez vos informations personnelles</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- INCLUSION JAVASCRIPT -->
<script src="../../Coiffadom/assets/script/script.js"></script>
<?php require_once "components/footer.php" ?>