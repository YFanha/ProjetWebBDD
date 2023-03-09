<?php
/**
 * @file      lost.php
 * @brief     This view is designed to inform the user when he tries to navigate to an resource who doesn't exist
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Event';
$titlebanner = 'Évenements';

ob_start();

?>   <!-- Title Page -->

    <br><h1 align="center" class="titlePages">Modification d'événements</h1><br>

    <table class="displayEvent">
        <tr>
            <th class="headerHover">Image :</th>
            <th class="headerHover">Nom de la soirée :</th>
            <th class="headerHover">Date de l'événement :</th>
            <th class="headerHover">Prix d'entrée :</th>
            <th class="headerHover">Type d'événement :</th>
        </tr>
        <tr>
            <form action="index.php?action=updateEventsSql&event_id=<?= $events['id'] ?>" method="post">
                <td><img height="237px" width="382px" src="<?= $events['pic'] ?>" alt="partyPicture"><br> <input type="file" name="eventFile" accept=".png, .jpg, .jpeg" size="20"></td>

                <td><input type="text" value="<?= $events['name'] ?>"/></td>
                <td><input type="text" value="<?= $events['date'] ?>"</td>
                <td><input type="text" value="<?= $events['entry_price'] ?>"></td>

                <td>
                    <select name="eventTypeEvent">
                        <option value=""><?php switch ($events['eventTypes_id']) {
                                case 1 :
                                    echo "Festival";
                                    break;
                                case 2 :
                                    echo "Soirée";
                                    break;
                                case 3 :
                                    echo "Rave Party";
                                    break;
                                default :
                                    echo "Pas un événement valide !";
                            } ?></option>

                        <option value="1">Festival</option>
                        <option value="2">Soirée</option>
                        <option value="3">Rave Party</option>
                    </select>

                </td>
                <br>
        <tr>
            <td><input type="submit" value="Modifier l'événement"></td>
        </tr>

    </table>

<?php

$content = ob_get_clean();
require 'gabarit.php';
?>