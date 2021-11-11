<?php
/**
 * @var \YuliiaK\Blog\Block\Author $block
 */
?>
<section title="AuthorPosts">
    <h1><?= $block->getAuthor()->getName() ?></h1>
    <ul class="posts-list">
        <?php foreach ($block->getPostsByAuthor() as $post) : ?>
            <li class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/post-img-default.jpg" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>"><?= $post->getName() ?></a>
                <span><?= $post->getDate() ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</section>