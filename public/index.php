<?php

require_once(__DIR__ . "/models/Blog.php");

$blog = new Blog;
$blog->setDirectory(__DIR__ . "/../notes/public");
?>

<html>
<head>
    <title>A simple blog</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <a href="/"><h1>A simple blog</h1></a>
        </div>
        <div>
        <?php if ($blog->isNotePage()) { ?>
            <div id="marked"><?php $blog->displayNote(); ?></div>
        <?php } else { ?>
            <div class="row">
                <h2>My posts</h2>
            </div>
            <div class="row">
            <?php $blog->listNotes();
} ?>
            </div>
        </div>
    </div>

    <script src="/marked.min.js"></script>
<script>
        document.getElementById('marked').innerHTML =
            marked(document.getElementById('marked').innerHTML);
    </script>
</body>
</html>

