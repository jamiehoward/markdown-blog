<?php

require_once(__DIR__ . '/Note.php');

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
        $dir = opendir($this->location);

        while($note = readdir($dir)) {
            if (strpos($note, 'md') !== false) {
                $this->notes[] = new Note($this->location . "/$note");
            }
        }

        closedir($dir);
    }

    public function notes()
    {
        $this->readNotes();

        return $this->notes;
    }

    public function findNoteByTitle($title)
    {
        foreach ($this->notes() as $note) {
            if ($note->getTitle(true) == $title) {
                return $note;
            } 
        }

        return false;
    }
}
