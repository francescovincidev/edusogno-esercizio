<?php

require_once __DIR__ . '/validation/User_validation.php';
require_once __DIR__ . '/../classes/Event.php';


class EventController
{
    use Db;



    public function deleteEvent($eventToDelete)
    {
        $db = $this->connect();
        $db->query("DELETE FROM eventi WHERE id = $eventToDelete");
    }

    public function getEvents()
    {
        $db = $this->connect();

        $result = $db->query("SELECT * FROM eventi");

        $events = [];

        while ($row = $result->fetch_assoc()) {
            $events[] = new Event(
                $row['id'],
                $row['attendees'],
                $row['nome_evento'],
                $row['data_evento']
            );
        }
        $db->close();
        return $events;
    }
}
