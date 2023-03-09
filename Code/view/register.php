<?php
/**
 * @file      register.php
 * @brief     This view is designed to display the register form
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Register';
$titlebanner = "S'enregistrer";

ob_start();
?>

<?php if (@$_GET['registerErrorMessage'] != null) : ?>
    <h5><span style="color:red"><?= $_GET['registerErrorMessage']; ?></span></h5>
<?php endif ?>

<div class="form">
    <form enctype="multipart/form-data" action="index.php?action=register"
          method="post">
        <label for="userEmail">
            <b>Adresse email * </b>
        </label>
        <input type="email" id="" class="info"
               placeholder="Adresse e-mail" name="inputUserEmailAddress" required>


        <label for="Username">
            <b>Nom d'utilisateur * </b>
        </label>
        <input type="text" class="info" placeholder="Nom d'utilisateur"
               id="" name="inputUsername" required>

        <label for="userPsw">
            <b>Mot de passe * </b>
        </label>
        <input type="password" class="info" id="inputPassword" name="inputPassword"
               value="" placeholder="Mot de passe" required>

        <label for="psw-repeat">
            <b>Vérifier le mot de passe * </b>
        </label>
        <input type="password" class="info" id=""
               name="inputVerifyPassword" value="" placeholder="Mot de passe (vérification)"
               required>

        <label for="phone_number">
            <b>Numéro de téléphone * </b>
        </label>
        <input type="tel" class="info" id="" name="inputPhoneNumber"
               value="" placeholder="Numéro de téléphone" maxlength="10" required>


        <label for="profile_pic">
            <b>Photo de profil</b>
        </label>
        <input type="file" class="" id="" name="inputProfilePic" accept=".png, .jpg, .jpeg" size="20">


        <input type="submit" id="btnSubmitRegister" value="Inscrivez-vous" class="" disabled>

    </form>
</div>


<?php
$content = ob_get_clean();
require 'gabarit.php';
?>