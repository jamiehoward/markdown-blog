<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="row">
    <div class="col">
        <a href="/"><h3><?php echo $env['BLOG_NAME'];?></h3></a>
    </div>
</div>

<div class="row">
    <div class="col">
        <p id="marked"><?php $blog->displayNote(); ?></p>
    </div>
</div>

<script src="/assets/marked.min.js"></script>
<script>
    document.getElementById('marked').innerHTML = marked(document.getElementById('marked').innerHTML);
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
