<?php
/** @var \YuliiaK\Blog\Block\NewestPostList $block */
?>
<section title="Newest Posts">
    <h2>Newest Posts</h2>
    <ul class="posts-list">
        <?php $count=1;
        foreach ($block->getNewestPosts() as $post) : ?>
            <li class="post">
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>">
                    <img src="/post-img-default.jpg" alt="<?= $post->getName() ?>" width="200"/>
                </a>
                <a href="/<?= $post->getUrl() ?>" title="<?= $post->getName() ?>"><?= $post->getName() ?></a>
                <span><?= $post->getDate() ?></span>
            </li>
            <?php if ($count++ === 3) :
                break;
            endif;
        endforeach; ?>

    </ul>
</section>
