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

    /**
     * Get the set filepath for this directory
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the directory's filepath
     *
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * Read the contents of all notes from the given directory
     *
     * @return void
     */
    protected function readNotes()
    {
        foreach (new \DirectoryIterator($this->location) as $file) {
            if ($file->isDot()) {
                continue;
            }

            if ($file->isFile() && $file->getExtension() == 'md') {
                $note = new Note($this->location . "/{$file->getFilename()}");
                $this->notes[$note->getTimestamp()] = $note;
            }
        }

        // Sort the notes by publish date
        krsort($this->notes);
    }

    /**
     * Return the array of notes
     *
     * @return array All notes in the set directory
     */
    public function notes()
    {
        $this->readNotes();

        return $this->notes;
    }

    /**
     * Retrieve a given note by title
     * @param  string $title
     * @return mixed Either the note or a failure
     */
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
