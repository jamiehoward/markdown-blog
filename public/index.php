<?php

require_once(__DIR__ . "/models/Directory.php");

$directory = new NoteDirectory(__DIR__ . "/../notes/public");

foreach ($directory->notes() as $note)
{
    echo $note->getTitle() . "<br/>";
}

