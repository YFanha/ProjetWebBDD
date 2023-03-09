<?php
/**
 * @file      home.php
 * @brief     This view is designed to display the home page
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

ob_start();
$title = " Partx - Accueil";
$titlebanner = 'Partx';
?>
    <!-- Slide1 -->



<br><br>
<div class="test"></div><br><br>


<?php
$content = ob_get_clean();
require "gabarit.php";
