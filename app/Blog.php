<?php

namespace App;

class Blog
{
    protected $directory;

    public function __construct($directory = null)
    {
        if (! is_null($directory)) {
            $this->directory = $directory;
        }
    }

    public function setDirectory($location)
    {
        $this->directory = new NoteDirectory($location);
    }

    public function listNotes()
    {
        echo "<ul>";

        foreach ($this->directory->notes() as $note) {
            echo "<li><a href='{$note->getLink()}'>{$note->getTitle(true)}</a></li>";
        }

        echo "</ul>";
    }

    public function isNotePage()
    {
        return ! empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/';
    }

    public function displayNote()
    {
        $title = substr(urldecode($_SERVER['REQUEST_URI']),1);

        $note = $this->directory->findNoteByTitle($title);

        if ($note) {
            echo $note->getContents();
        }
    }
}
