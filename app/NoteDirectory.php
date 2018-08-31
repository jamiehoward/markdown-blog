<?php

namespace App;

class NoteDirectory
{
    protected $location;
    protected $notes = [];

    public function __construct($location = null)
    {
        if (! is_null($location)) {
            $this->setLocation($location);
        }
    }

	public function getLocation()
	{
			return $this->location;
	}

	public function setLocation($location)
	{
			$this->location = $location;
	}

	protected function readNotes()
    {
        foreach (new \DirectoryIterator ($this->location) as $note) {
            if ($note->isDot()) continue;

            if ($note->isFile() && $note->getExtension() == 'md') {
                $this->notes[] = new Note($this->location . "/{$note->getFilename()}");
            }
        }

    }

    public function notes()
    {
        $this->readNotes();

        return $this->notes;
    }

    public function findNoteByTitle($title)
    {
        foreach ($this->notes() as $note) {
            if (strtoupper($note->getTitle(true)) == strtoupper($title)) {
                return $note;
            } 
        }

        return false;
    }
}
