<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row col">
    <a href="/"><h3><?php echo $env['BLOG_NAME'];?></h3></a>
</div>

<div class="row col">
    <div id="marked"><?php $blog->displayNote(); ?></div>
</div>

<script src="/marked.min.js"></script>
<script>
    document.getElementById('marked').innerHTML = marked(document.getElementById('marked').innerHTML);
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
