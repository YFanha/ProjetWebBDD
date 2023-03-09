<?php
/**
 * @file      lost.php
 * @brief     This view is designed to inform the user when he tries to navigate to an resource who doesn't exist
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = 'Partx - Events';
$titlebanner = 'Évenements';


ob_start();
?>


    <div class="container">
        <?php foreach ($events as $event) : ?>

            <?php
            //Get list of the event's owners

            $ownerList = getEventOwner($event['id']);
            $isOwner = isEventOwner($event['id'], $_SESSION['user_id'], $ownerList);
            ?>

            <div class="deck">
                <div class="card clickcard">
                    <div class="front face">
                        <h2><img class="eventImage" src="<?= $event['pic'] ?>" alt="partyPicture"></h2>
                        <h3 class="enventTitle"><?= $event['name'] ?></h3>
                        <div class="bottext">
                            <h3><?= $event['entry_price'] ?> .-</h3>
                        </div>

                    </div>
                    <div class="back face">

                        <ul>
                            <li><?= $event['date'] ?></li>
                            <li><?php switch ($event['eventTypes_id']) {
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
                                } ?></li>
                            <li></li>
                            <li><a class=" btn-info detailEvent" href="index.php?action=detailEvent&event_id=<?= $event['id'] ?>">Détails</a></li>
                        </ul>



                    </div>
                </div>
            </div>


            <!--    --><?php //if (isset($_SESSION['user_email'])) : ?>
            <!--        <th><b>S'inscrire </b></th>-->
            <!--        <th><b>Modifier</b></th>-->
            <!--        <th><b>Supprimer</b></th>-->
            <!--    --><?php //endif; ?>

            <!---->
            <!--    --><?php
//
//    //display crud option if a user is logged in
//    if (isset($_SESSION['user_email'])):?>
            <!---->
            <!--        --><?php //if ($_SESSION['userType'] == USER_TYPE_ADMIN || $isOwner === true): ?>
            <!---->
            <!--            <td>-->
            <!--                <a href="index.php?action=updateEvents&event_id=--><? //= $event['id'] ?><!--">-->
            <!--                    <button class=" btn btn-warning">Modifier</button>-->
            <!--                </a>-->
            <!--            </td>-->
            <!---->
            <!--            <td>-->
            <!--                <a href="index.php?action=deleteEvents&event_id=--><? //= $event['id'] ?><!--">-->
            <!--                    <button class=" btn btn-danger">Supprimer</button>-->
            <!--                </a>-->
            <!--            </td>-->
            <!--            </tr>-->
            <!---->
            <!--        --><?php //endif; ?>
            <!---->
            <!--        --><?php //if (!$isOwner): ?>
            <!--            <td>-->
            <!--                <a href="index.php?action=joinAnEvent&event_id=--><? //= $event['id'] ?><!--">-->
            <!--                    <button class=" btn btn-primary">S'inscrire à cet événement</button>-->
            <!--                </a>-->
            <!--            </td>-->
            <!--        --><?php //endif; ?>
            <!---->
            <!--    --><?php //endif; ?>
        <?php endforeach; ?>    </div>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>