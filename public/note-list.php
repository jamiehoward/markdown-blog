<html>
<head>
<title><?php echo $env['BLOG_NAME'];?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
        <a href="/"><h1><?php echo $env['BLOG_NAME']; ?></h1></a>
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

