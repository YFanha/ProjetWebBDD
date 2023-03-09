<?php

//add
/**
 * Add place to DB
 * @param $street
 * @param $postcode
 * @param $city
 * @param $additional_infos
 * @return bool|null
 */
function addPlace($street, $postcode, $city, $additional_infos)
{
    require "model/dbconnector.php";

    $result = false;

    //Prepare Query
    $query = "INSERT INTO places (street, postcode, city, additional_infos) VALUES ";
    $query .= "('$street', '$postcode', '$city', '$additional_infos');";

    //execute query
    $result = executeQueryIUD($query);

    return $result;

}

/**
 * Add Event to DB and move the img in the directory or set default img
 * @param $name
 * @param $eventTypes_id
 * @param $date
 * @param $thingsToBring
 * @param $description
 * @param $pic
 * @param $entry_price
 * @param $address
 * @return bool|null
 */
function addEventBD($name, $eventTypes_id, $date, $thingsToBring, $description, $pic, $entry_price, $address)
{
    //set default img
    switch ($eventTypes_id) {
        case 1:
            $img = "festival.jpg";
            break;
        case 2:
            $img = "party.jpg";
            break;
        case 3:
            $img = "rave.jpg";
            break;
    }
    $default_img = DEFAULT_PICS_PATH . $img;


    //Get the place id
    $placeId = getPlaceId($address['street'], $address['postcode'], $address['city'], $address['infos']);

    //Prepare query for register the event
    $query = "INSERT INTO events (name,eventTypes_id ,date, entry_price, Places_id,thingsTo_bring,Description,pic) VALUES";
    $query .= " ('$name','$eventTypes_id', '$date', '$entry_price', '$placeId', '$thingsToBring', '$description','$default_img')";

    require_once 'model/dbConnector.php';

    //Execute query
    $result = executeQueryIUD($query);

    //Register who registered the events
    if ($result) {
        //get event id in DB
        $event_id = getEventID($name, $date, $description, $entry_price, $placeId);

        //Get user session
        $user_id = $_SESSION['user_id'];

        //query for register who organize the event
        $queryOrganize = "INSERT INTO users_organize_events (events_id, users_id) VALUES ('$event_id', '$user_id')";

        $result = executeQueryIUD($queryOrganize);

        //if it went wrong, delete the event
        if (!$result) {
            deleteEventDB($event_id);
        }
    }

    //img
    if ($result) {

        //Check if an image was uploaded, error level 4 = no file
        if ($pic['error'] != 4) {

            //get file extension
            $fileExtension = "." . pathinfo($pic['name'], PATHINFO_EXTENSION);

            //get new filename for no duplicate using time and event_id
            $newRandomFileName = strval(time()) . "_" . $event_id . $fileExtension;

            $fullPath = EVENTS_PIC_PATH . $newRandomFileName;

            //Move the img
            if (move_uploaded_file($pic['tmp_name'], $fullPath)) {
                $queryUpdate = "UPDATE events
                SET pic = '$fullPath'
                WHERE id = '$event_id';";

                executeQueryIUD($queryUpdate);
            }

        }
    }

    return $result;
}


//Get
/**
 * get events list
 * @return array : $queryResult
 */
function getEvents()
{
    $loginQuery = "SELECT * FROM events";
    require_once "model/dbconnector.php";
    $queryResult = executeQuerySelect($loginQuery);
    return $queryResult;


}

/**
 * Function to get the place id by his values
 * @param $street
 * @param $postcode
 * @param $city
 * @param $infos
 * @return mixed
 */
function getPlaceId($street, $postcode, $city, $infos)
{

    $query = "SELECT * FROM places
                WHERE street LIKE '$street'
                AND postcode = '$postcode' AND city LIKE '$city' AND
                additional_infos LIKE '$infos';";

    $address = executeQuerySelect($query);

    return $address[0]['id'];
}

/**
 *
 * @param $event_id
 * @return mixed
 */
function getEvent($event_id)
{
    $query = "SELECT * FROM events WHERE id = '$event_id'";

    require_once "model/dbconnector.php";

    $queryResult = executeQuerySelect($query);

    return $queryResult[0];
}

/**
 * Get Event'id by its values
 * @param $name
 * @param $date
 * @param $description
 * @param $entry_place
 * @param $Places_id
 * @return mixed
 */
function getEventID($name, $date, $description, $entry_place, $Places_id)
{
    $query = "SELECT * FROM events
            WHERE name LIKE '$name' 
            AND date = '$date' 
            AND entry_price like '$entry_place'
            AND description LIKE '$description' 
            AND Places_id LIKE '$Places_id';";

    $event = executeQuerySelect($query);

    return $event[0]['id'];
}

/**
 * Get events's list without id's (replaced by correct joined values)
 * @return array|null
 */
function getEventsWithJoin()
{
    require "model/dbconnector.php";

    $query = "SELECT events.id, events.name, events.pic, events.DATE, events.entry_price, events.thingsTo_bring,events.Description, places.city, eventstypes.name 
                FROM `events`
                INNER JOIN places ON Places_id = places.id
                INNER JOIN eventstypes ON eventTypes_id = eventstypes.id;";

    $result = executeQuerySelect($query);

    return $result;
}

/**
 * Get an event with the joined values
 * @return array|null
 */
function getAnEventWithJoin($event_id)
{
    require "model/dbconnector.php";

    $query = "SELECT events.id, events.name, events.pic, events.DATE, events.entry_price, events.thingsTo_bring,events.Description, places.city, eventstypes.name 
                FROM `events`
                INNER JOIN places ON Places_id = places.id
                INNER JOIN eventstypes ON eventTypes_id = eventstypes.id
                WHERE events.id = '$event_id'";

    $result = executeQuerySelect($query);

    return $result[0];
}

/**
 * Get participants of an event
 */
function getParticipants()
{

}


//Delete
/**
 * Delete event in DB
 * @param $event_id
 * @return bool|null
 */
function deleteEventDB($event_id)
{
    require "model/dbconnector.php";

    $event = getEvent($event_id);
    $place_id = $event['Places_id'];

    $deleteQuery = "DELETE FROM events
                            WHERE id = '$event_id'";

    $result = executeQueryIUD($deleteQuery);

    deletePlace($place_id, true);
    deleteImg($event['pic']);

    return $result;
}

/**
 * Delete a Place
 * @param $placeToDelete
 * @param false $id_known
 */
function deletePlace($placeToDelete, $id_known = false)
{

    if ($id_known) {
        $placeId = $placeToDelete;
    } else {
        $placeId = getPlaceId($placeToDelete['street'], $placeToDelete['postcode'], $placeToDelete['city'], $placeToDelete['infos']);
    }

    $query = "DELETE FROM places
                WHERE id = '$placeId'";

    $result = executeQueryIUD($query);
}

/**
 * Delete an img
 * @param $imgToDelete
 */
function deleteImg($imgToDelete)
{

    //Verify if it's not a default img
    $defaults_img = scandir(DEFAULT_PICS_PATH);
    $isDefaultImg = false;

    for ($imgIndex = 0; $imgIndex < count($defaults_img); $imgIndex++) {
        $pathImg = DEFAULT_PICS_PATH . $defaults_img[$imgIndex];
        if ($imgToDelete === $pathImg) {
            $isDefaultImg = true;
        }
    }

    //If this is not a default img, delete it
    if (!$isDefaultImg) {
        unlink($imgToDelete);
    }
}

//Update
/**
 * Upadate an Events
 * @param $name
 * @param $pic
 * @param $date
 * @param $entryPrice
 * @param $thingsToBring
 * @param $desc
 * @param $placeId
 * @param $enventTypeId
 * @return bool|null
 */
function updateEvents($name, $pic, $date, $entryPrice, $thingsToBring, $desc, $placeId, $enventTypeId)
{
    $idEvent = $_GET['event_id'];
    require_once "model/dbconnector.php";
    $updateQuery = "UPDATE events SET name = '$name', pic = '$pic', date = '$date', entry_price = '$entryPrice', thingsTo_bring = '$thingsToBring', Description = '$desc', Places_id = '$placeId', eventTypes_id = '$enventTypeId' WHERE id = '$idEvent' ";
    $queryResult = executeQueryIUD($updateQuery);
    return $queryResult;
}


//Join table
/**
 * Add user to events (participation)
 * @param $event_id
 * @return bool|null
 */
function registrationToEvent($event_id)
{
    require "model/dbconnector.php";

    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO users_participate_events (users_id, events_id) VALUES 
            ('$user_id', '$event_id')";

    $result = executeQueryIUD($query);
    return $result;
}

/**
 * get the owner of an event (specified)
 * @param $event_id
 * @return array|null
 */
function getEventOwner($event_id)
{
    /*$query = "SELECT events.name, users.username
                FROM users_organize_events
                INNER JOIN `events` ON events_id = events.id
                INNER JOIN `users` ON users_id = users.id
                WHERE events_id = '$event_id';";
     */
    $query = "SELECT users_id, users.username
                FROM users_organize_events
                INNER JOIN users ON users.id = users_id
                WHERE events_id = '$event_id';";

    $result = executeQuerySelect($query);
    return $result;
}