<section title="Newest Posts">
    <h2>Newest Posts</h2>
    <ul class="posts-list">
        <?php $posts = blogGetPost();
        $count=1;
        foreach (blogGetNewPosts($posts) as $post) : ?>
            <li class="post">
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>">
                    <img src="/post-img-default.jpg" alt="<?= $post['name'] ?>" width="200"/>
                </a>
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>"><?= $post['name'] ?></a>
                <span>by <?= $post['author'] ?></span>
                <span><?= $post['date'] ?></span>
            </li>
            <?php if ($count++ == 3) break;
        endforeach; ?>

    </ul>
</section>