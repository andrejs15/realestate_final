<?php
/** @var string $contentHTML */
/** @var \Framework\Support\LinkGenerator $link */
/* AI-assisted Vaííčko layout preserving the original home/create shell. */
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
    <button id="toggle-map" class="fa fa-map-marker" aria-label="Toggle map"></button>
    <div class="sidebar" id="sidebar-section">
        <img src="<?= $link->asset('img/map.png') ?>" alt="Map" width="463">
    </div>
</div>
<script src="<?= $link->asset('js/app.js') ?>"></script>
</body>
</html>
