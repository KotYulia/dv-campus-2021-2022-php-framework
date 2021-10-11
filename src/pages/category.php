<section title="Posts">
    <h1><?= $data['name'] ?></h1>
    <ul class="posts-list">
        <?php foreach (blogGetCategoryPost($data['category_id']) as $post) : ?>
            <li class="post">
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>">
                    <img src="/post-img-default.jpg" alt="<?= $post['name'] ?>" width="200"/>
                </a>
                <a href="/<?= $post['url'] ?>" title="<?= $post['name'] ?>"><?= $post['name'] ?></a>
                <span>by <?= $post['author'] ?></span>
                <span><?= $post['date'] ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</section>