<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
/* AI-assisted Vaííčko layout migrated from the original Laravel layout. */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <?php require dirname(__DIR__) . '/Partials/head.view.php'; ?>
</head>
<body>
<div class="content flex vajko-page">
    <div class="content-box">
        <header class="flex">
            <?php require dirname(__DIR__) . '/Partials/menu.view.php'; ?>
        </header>
        <?= $contentHTML ?>
    </div>
</div>
<script src="<?= $link->asset('js/app.js') ?>"></script>
</body>
</html>
