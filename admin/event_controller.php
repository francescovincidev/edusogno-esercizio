<?php
require_once __DIR__ . '/../classes/EventController.php';

if (isset($_GET['id_event'])) {
    $eventToDelete = $_GET['id_event'];

    $newEventController = new EventController;
    $newEventController->deleteEvent($eventToDelete);
    header('Location: http://localhost/edusogno-esercizio/admin');
}
