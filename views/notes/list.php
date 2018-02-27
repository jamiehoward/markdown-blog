<?php include(__DIR__ . "/../layouts/header.php");?>

<div class="row col">
  <a href="/"><h1><?php echo $env['BLOG_NAME'];?></h1></a>
</div>

<div class="row">
    <?php $blog->listNotes();?>
</div>

<?php include(__DIR__ . "/../layouts/footer.php");?>
