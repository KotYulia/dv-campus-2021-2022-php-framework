<?php
/** @var \YuliiaK\Blog\Block\Post $block */
$post = $block->getPost();
$author = $block->getAuthor();
?>
<div class="post-page">
    <img src="/post-img-default.jpg" alt="<?= $post->getName() ?>" width="300"/>
    <h1><?= $post->getName() ?></h1>
    <p><?= $post->getDescription() ?></p>
    <span>by <a href="<?= $author->getUrl() ?>"><?= $author->getName() ?></a></span>
    <span><?= $post->getDate() ?></span>
</div>