<?php
/** @var \YuliiaK\Framework\View\Renderer $this */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{DV.Campus} PHP Framework</title>
    <style>
        header,
        main,
        footer {
            border: 1px dashed black;
        }

        ul {
            list-style: none;
        }

        h1, h2 {
            text-align: center;
        }

        .posts-list {
            display: flex;
            justify-content: space-around;
        }

        .posts-list .post {
            max-width: 30%;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<header>
    <a href="/" title="{DV.Campus} PHP Framework">
        <img src="logo.jpg" alt="{DV.Campus} Logo" width="200"/>
    </a>
    <nav>
        <?= $this->render(\YuliiaK\Blog\Block\CategoryList::class) ?>
    </nav>
</header>

<main>
    <?= $this->render($this->getContent(), $this->getContentBlockTemplate()) ?>
</main>

<footer>
    <nav>
        <ul>
            <li>
                <a href="/about-us">About Us</a>
            </li>
            <li>
                <a href="/terms-and-conditions">Terms & Conditions</a>
            </li>
            <li>
                <a href="/contact-us">Contact Us</a>
            </li>
        </ul>
    </nav>
    <p>© Default Value 2021. All Rights Reserved.</p>
</footer>
</body>
</html>