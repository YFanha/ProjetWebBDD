<?php
/**
 * @file      index.php
 * @brief     This file is the rooter managing the link with controllers.
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

session_start();
require "controller/navigation.php";
require "controller/users.php";
require "controller/eventsController.php";

/***************Constante*************/
//Type d'utilisateurs (correspond à l'id du type dans la table "userTypes")
define("USER_TYPE_CLIENT", 2);
define("USER_TYPE_ADMIN", 1);

define("PROFILE_PIC_PATH", "view/content/images/profile_pics/");
define("DEFAULT_PROFILE_PIC", "view/content/images/default_pics/default-user.png");
define("DEFAULT_PICS_PATH", "view/content/images/default_pics/");
define("EVENTS_PIC_PATH", "view/content/images/events_pics/");

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            home();
            break;
        case 'login' :
            login($_POST);
            break;
        case 'logout' :
            logout();
            break;
        case 'register' :
            register($_POST, $_FILES);
            break;
        case 'profil' :
            profil();
            break;
        case 'displayCreateEvents' :
            displayCreateEvents();
            break;
        case 'createEvents' :
            createEvents();
            break;
        case 'detailEvent' :
            detailEvent($_GET['event_id']);
            break;
        case 'displayEvents' :
            displayEvents();
            break;
        case 'deleteEvents':
            deleteEvents($_GET['event_id']);
            break;
        case 'updateEvents' :
            updateEvent($_GET['event_id']);
            break;
        case 'updatePassword' :
            updatePassword($_POST);
            break;
        case 'formChangePwd':
            displayFormPwd();
            break;
        case 'updateEventsSql':
            updateEvents();
            break;
        case 'joinAnEvent':
            joinAnEvent($_GET['event_id']);
            break;
        default :
            lost();
    }
} else {
    home();
}