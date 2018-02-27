<?php

class Note
{
    protected $location;
    protected $title;
    protected $content;

    public function __construct($location = null)
    {
        if (! is_null($location)) {
            $this->location = $location;
        }
    }

    public function getContents()
    {
        return file_get_contents($this->location);
    }

    public function getTitle()
    {
        return file($this->location)[0];
    }
}

