<?php

/**
 *  Get the events and call the page to display them
 */
function displayEvents()
{
    require_once("model/eventManager.php");
    $events = getEvents();
    require "view/event.php";

}

/**
 * Function to get values from the form, and call the functions to write them in the DB
 */
function createEvents()
{
    $resultPlace = false;
    $result = false;

    require_once("model/eventManager.php");

    $address = array(
        "postcode" => $_POST['eventPlacePostCode'],
        "street" => $_POST['eventPlaceStreet'],
        "city" => $_POST['eventPlaceCity'],
        "infos" => $_POST['eventPlaceInfos']
    );


    $resultPlace = addPlace($address['street'], $address['postcode'], $address['city'], $address['infos']);

    if ($resultPlace) {

        $result = addEventBD($_POST['eventName'], $_POST['eventTypeEvent'], $_POST['eventDate'], $_POST['eventThingsToTake'], $_POST['eventDescription'], $_FILES['eventFile'], $_POST['eventEntryPrice'], $address);

        if ($result) { //cas OK si result=1
            displayEvents();
        } else {
            require_once("controller/navigation.php");
            $result = deletePlace($address);
            displayCreateEvents();
        }
    }
}

/**
 * Function to delete and event by its id
 * @param $event_id
 */
function deleteEvents($event_id)
{
    require "model/eventManager.php";
    $result = deleteEventDB($event_id);

    if ($result) {
        $_GET['deleteErrorMessage'] = null;
        displayEvents();
    } else {
        $_GET['deleteErrorMessage'] = "Erreur de la suppression";
        displayEvents();
    }
}

/**
 * Function to update an event
 * @param $event_id
 */
function updateEvent($event_id)
{
    require_once("model/eventManager.php");
    $events = getEvent($event_id);
    require "view/updateEvents.php";
}

/**
 * Function to add an user to an event (participation)
 * @param $event
 */
function joinAnEvent($event)
{
    require "model/eventManager.php";

    $result = registrationToEvent($event);
    if ($result) {
        $_GET['joinEventErrorMessage'] = "Inscrit avec succès";
    } else {
        $_GET['joinEventErrorMessage'] = "Erreur d'inscription, veuillez réessayer";
    }
    displayEvents();

}

