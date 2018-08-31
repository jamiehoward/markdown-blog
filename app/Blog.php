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

    /**
     * Retrieve the blog directory
     *
     * @return NoteDirectory
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Set the directory of the blog by filepath
     *
     * @param string $location The filepath to the notes directory
     * @return void
     */
    public function setDirectory($location)
    {
        $this->directory = new NoteDirectory($location);
    }

    /**
     * Echo out a list of notes, excluding "pages"
     *
     * @return void
     */
    public function listNotes()
    {
        echo "<ul>";

        foreach ($this->directory->notes() as $note) {
            if ( ! $note->isPage()) {
                echo "<li><a href='{$note->getLink()}'>{$note->getTitle(true)}</a></li>";
            }
        }

        echo "</ul>";
    }

    /**
     * Determine whether currently within a note page
     *
     * @return boolean
     */
    public function isNotePage()
    {
        return ! empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] !== '/';
    }

    /**
     * Echo out the content of the specified note
     *
     * @return void
     */
    public function displayNote()
    {
        $title = substr(urldecode($_SERVER['REQUEST_URI']),1);

        $note = $this->directory->findNoteByTitle($title);

        if ($note) {
            echo $note->getContents();
        }
    }
}
