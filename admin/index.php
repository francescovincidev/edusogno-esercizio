<?php

require_once __DIR__ . '/../classes/EventController.php';

$event_controller = new EventController();
$events = $event_controller->getEvents();

?>

<?php
require_once __DIR__ . '/../section/top.php' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno Admin</title>
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100;0,9..40,200;0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;0,9..40,900;0,9..40,1000;1,9..40,100;1,9..40,200;1,9..40,300;1,9..40,400;1,9..40,500;1,9..40,600;1,9..40,700;1,9..40,800;1,9..40,900;1,9..40,1000&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    echo "<div class='events-admin'>";
    foreach ($events as $event) {
        echo   "<div class='event-admin'>";
        echo "<span class='event-title'>" . $event->nome_evento . "</span>";
        echo "<span class='event-date'>" . $event->data_evento . "</span>";
        echo "<span class='attendes'>" . $event->attendees . "</span>";

        echo "<form class='delete-event' caction='event_controller.php' method='get'>
<input type='hidden' name='id_event' value='$event->id'>
<button class='delete-event-btn' type='submit'>ELIMINA</button>
</form>";

        echo   "</div>";
    }
    echo "</div>";
    ?>


    <?php require_once __DIR__ . '/../section/bottom.php' ?>
</body>

</html>