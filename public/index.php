<?php

require __DIR__ . '/../vendor/autoload.php';

function getEnvironmentVariables() {
    $env = [];
    $file = file(__DIR__ . "/../.env");
    foreach($file as $line) {
        $item = explode('=', $line);
        $env[$item[0]] = $item[1];
    }

    return $env;
}

$env = getEnvironmentVariables();

$blog = new \App\Blog;
$blog->setDirectory(__DIR__ . "/../notes");

require_once __DIR__ . "/../views/notes/list.php";
