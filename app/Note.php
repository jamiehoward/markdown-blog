<?php

namespace App;

use Carbon\Carbon;

class Note
{
    protected $location;
    protected $title;
    protected $content;
    public $timestamp;
    protected $pages = ['about', 'coding', 'design'];

    public function __construct($location = null)
    {
        if (! is_null($location)) {
            $this->setLocation($location);
        }
    }

    /**
     * Get the set location of the note
     *
     * @return string The filepath to the note file
     */
    public function getLocation()
    {
        return $this->location;
    }

    public function getTimestamp()
    {
        if ($this->getPublishDate()) {
            return strtotime($this->getPublishDate()->toDateTimeString());
        }
    }

    /**
     * Set the location of the note
     *
     * @param string $location The filepath to the note
     */
    public function setLocation($location)
    {
        if (file_exists($location)) {
            $this->location = $location;
        } else {
            throw new \Exception("No file could not be found for location: $location");
        }
    }

    /**
     * Retrieve the contents from the note
     *
     * @return string The note's contents
     */
    public function getContents()
    {
        return file_get_contents($this->location);
    }

    /**
     * Retrieve the note's title
     *
     * @param  boolean $format Whether to remove the preceding #
     * @return string
     */
    public function getTitle($format = false)
    {
        $title = trim(file($this->location)[0]);

        return ($format) ? substr($title, 2) : $title;
    }

    /**
     * Retrieve the URI element for the note
     *
     * @return string
     */
    public function getLink()
    {
        $link = urlencode($this->getTitle(true));

        return "/$link";
    }

    /**
     * Determine whether the note is a page or not
     *
     * @return boolean
     */
    public function isPage()
    {
        return in_array(strtolower($this->getTitle(true)), $this->pages);
    }

    protected function getLines()
    {
        return explode("\n", $this->getContents());
    }

    public function returnDateFromString($string)
    {
        $date = substr($string, 18);
        $date = substr($date, 0, -9);
        $date = str_replace('@', '', $date);
        return $date;
    }

    public function getPublishDate()
    {
        foreach ($this->getLines() as $line) {
            if (is_numeric(strpos($line, '_Posted '))) {
                return new Carbon($this->returnDateFromString($line));
            }
        }
    }
}

