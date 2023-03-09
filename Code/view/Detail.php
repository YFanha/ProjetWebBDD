<?php
/**
 * @file      lost.php
 * @brief     This view is designed to inform the user when he tries to navigate to an resource who doesn't exist
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Détail';
$titlebanner = 'Détail';

ob_start();
?>





<?php
$content = ob_get_clean();
require "gabarit.php"

?>


