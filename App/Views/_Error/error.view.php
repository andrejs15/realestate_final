<?php
/* AI-assisted application error view for the Vaííčko migration. */
$message = htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8');
?>
<main class="w-full px-8 py-10">
    <section class="mx-auto max-w-2xl rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-bold">Chyba <?= (int)$exception->getCode() ?></h1>
        <p class="mt-3 text-gray-700"><?= $message ?></p>
        <?php if ($showDetail && $exception->getPrevious()) { ?>
            <pre class="mt-5 overflow-auto rounded bg-gray-100 p-4 text-xs"><?= htmlspecialchars($exception->getPrevious()->getTraceAsString(), ENT_QUOTES, 'UTF-8') ?></pre>
        <?php } ?>
        <a class="mt-5 inline-block !text-blue-600" href="<?= $link->url('home.index') ?>">Späť na ponuku</a>
    </section>
</main>
