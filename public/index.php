<?php

require_once(__DIR__ . "/models/Blog.php");

$blog = new Blog;
$blog->setDirectory(__DIR__ . "/../notes/public");
?>

<html>
<head>
    <title>A simple blog</title>
</head>
<body>
    <div class="container">
        <h1>A simple blog</h1>
        <h2>My posts</h2>
        <?php $blog->listNotes(); ?>
    </div>

    <?php
    if ($blog->isNotePage()) {
        echo "<div id='marked'>";
        $blog->displayNote();
        echo "</div>";
    }
    ?>

    <script src="/marked.min.js"></script>
    <script>
        document.getElementById('marked').innerHTML =
            marked('# Marked in browser\n\nRendered by **marked**.');
    </script>
</body>
</html>

