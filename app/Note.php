<?php

namespace App;

class Note
{
    protected $location;
    protected $title;
    protected $content;
    protected $pages = ['about', 'coding', 'design'];

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

    public function getTitle($format = false)
    {
        $title = trim(file($this->location)[0]);

        return ($format) ? substr($title, 2) : $title;
    }

    public function getLink()
    {
        $link = urlencode($this->getTitle(true));
        return "/$link";
    }

    public function isPage()
    {
        return in_array(strtolower($this->getTitle()), $this->pages);
    }
}

