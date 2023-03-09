<?php
/**
 * @file      lost.php
 * @brief     This view is designed to inform the user when he tries to navigate to an resource who doesn't exist
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Event';
$titlebanner = 'Créer un événement';

ob_start();
?>   <!-- Title Page -->
    <div class="form">

        <form action="index.php?action=createEvents" method="POST" class="formCreateParty"  enctype="multipart/form-data">

            <input type="text" name="eventName" maxlength="18" class="eventName" placeholder="Nom de l'événement (pas plus de 18 caractères)" required>

            <label>
                Type d'événements</label> <br>
                <select name="eventTypeEvent">
                    <option value="">Choisissez</option>
                    <option value="1">Festival</option>
                    <option value="2">Soirée</option>
                    <option value="3">Rave Party</option>
                </select>
            </label>
            <label> Date de l'événement</label><br>
            <input type="date" name="eventDate" required>
            <div>
                <br>
                <label>Rue</label>
                <input type="text" name="eventPlaceStreet" placeholder="Route de Nyon 14" required>
            </div>
            <div>
                <label>Code postal</label>
                <input type="text" name="eventPlacePostCode" placeholder="1264" required>
            </div>
            <div>
                <label>Ville</label>
                <input type="text" name="eventPlaceCity" placeholder="Sainte-Croix" required>
            </div>
            <div>
                <label>Prix d'entrée</label>
                <input type="text" name="eventEntryPrice" placeholder="1'000 .-" required>
            </div>
            <div>
                <label>Info complémentaires</label>
                <input type="text" name="eventPlaceInfos" placeholder="2 ème étage, ...">
            </div>
            <input type="text" name="eventThingsToTake" placeholder="Élément à apporter">
            <textarea placeholder="Description" name="eventDescription"></textarea>
            <input type="file" name="eventFile" accept=".png, .jpg, .jpeg" size="20">
            <input type="submit" value="Crée l'événement">
        </form>
    </div>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>