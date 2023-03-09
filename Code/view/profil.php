<?php
/**
 * @file      home.php
 * @brief     This view is designed to display the home page
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

ob_start();
$title = " Partx - Profile";
$titlebanner = 'Bonjour';
?>

    <div class="profileInfo">
        <div class="imageCropper">
            <img src="<?= $_SESSION['profile_pic'] ?>" class="profilePic">
        </div>
        <div>
            <p> <span class="profileTitle">Username</span> : <?= $_SESSION['username'] ?></p>
        </div>
        <div>
            <p> <span class="profileTitle">E-mail</span> : <?= $_SESSION['user_email'] ?></p>
        </div>
        <div class="profileModif">
            <a  href="index.php?action=formChangePwd"><button class="profileModifbtn">Modifier</button></a>
        </div>

    </div>
<?php
$content = ob_get_clean();
require "gabarit.php";
