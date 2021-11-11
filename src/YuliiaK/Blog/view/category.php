<?php
/**
 * @var \YuliiaK\Blog\Block\Category $block
 */
?>
<section title="CategoryPosts">
    <h1><?= $block->getCategory()->getName() ?></h1>
    <ul class="posts-list">
        <?php foreach ($block->getPostsByCategory() as $post) :
        $author = $block->getAuthorByPost($post); ?>
            <li class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/post-img-default.jpg" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>"><?= $post->getName() ?></a>
                <span>by <a href="<?= $author->getUrl() ?>"><?= $author->getName() ?></a></span>
                <span><?= $post->getDate() ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</section>