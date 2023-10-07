<?php
class Event
{
    public $id;

    public $attendees;
    public $nome_evento;
    public $data_evento;

    public function __construct($id, $attendees, $nome_evento, $data_evento)
    {
        $this->id = $id;

        $this->attendees = $attendees;
        $this->nome_evento = $nome_evento;
        $this->data_evento = $data_evento;
    }
}
