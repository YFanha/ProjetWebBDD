<?php
/**
 * @file      login.php
 * @brief     This view is designed to display the login form
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Login/Logout';
$titlebanner = 'Connexion';
ob_start();
?>
<?php //if ($loginErrorMessage != null) : ?>
<?php if (isset($loginErrorMessage)) : ?>
    <h5><span style="color:red"><?= $loginErrorMessage; ?></span></h5>
<?php endif ?>


    <!-- content page -->

    <div class="form">
        <form action="index.php?action=login" method="post">
            <h4>
                Inscrivez vos informations
            </h4>

            <div>
                <input class="info" type="email" name="inputUserEmailAddress" placeholder="Nom d'utilisateur">
            </div>

            <div>
                <input class="info" type="password" name="inputUserPsw" placeholder="Mot de passe">
            </div>
            <input type="submit" value="login" class="">
            <?php if (@$_GET['loginErrorMessage'] != null): ?>
                <label class="errorMsg"><?=@$_GET['loginErrorMessage']?></label>
            <?php endif;?>
            <br> Pas de compte ? <a href="index.php?action=register">Inscrivez-vous</a>

        </form>
    </div>
    <br>
    <br>
    <br>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>