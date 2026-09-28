<?php
/** @var \App\Models\Property $property */
/** @var \App\Models\PropertyImage[] $images */
/* AI-assisted migration of the in-progress Laravel property detail page. */
$esc = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<main class="w-full">
    <section class="main-section property-detail !max-w-none w-full px-8 pb-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div>
                <?php if ($images !== []) { ?>
                    <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
                        <?php foreach ($images as $image) { ?>
                            <div class="h-60 overflow-hidden rounded-md">
                                <img src="<?= $link->asset($image->imagePath) ?>" alt="<?= $esc($property->title) ?>" class="h-full w-full object-cover">
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="mt-4 h-60 overflow-hidden rounded-md">
                        <img src="<?= $link->asset('img/house1.png') ?>" alt="<?= $esc($property->title) ?>" class="h-full w-full object-cover">
                    </div>
                <?php } ?>
            </div>

            <div class="pt-4">
                <h1 class="text-2xl font-bold"><?= $esc($property->title) ?></h1>
                <p class="mt-2 text-xl font-semibold"><?= number_format((int)$property->price, 0, ',', ' ') ?> €</p>
                <p class="mt-2"><strong>Poloha:</strong> <?= $esc($property->location) ?></p>
                <div class="mt-4">
                    <p><strong>Typ:</strong> <?= $esc($propertyType?->name ?? '-') ?></p>
                    <p><strong>Štýl:</strong> <?= $esc($styleOfHome?->name ?? '-') ?></p>
                    <p><strong>Izby:</strong> <?= (int)$property->rooms ?></p>
                    <p><strong>Kúpeľne:</strong> <?= (int)$property->baths ?></p>
                    <p><strong>Rozloha:</strong> <?= (int)$property->size ?> m²</p>
                </div>

                <?php if ($accessibilityFeatures !== []) { ?>
                    <div class="mt-5">
                        <h2 class="mb-2 text-lg font-semibold">Accessibility features</h2>
                        <div class="flex flex-wrap gap-2">
                            <?php foreach ($accessibilityFeatures as $feature) { ?>
                                <span class="rounded-full border border-gray-300 px-3 py-1 text-sm text-gray-700"><?= $esc($feature->name) ?></span>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-200 pt-6">
            <h2 class="text-xl font-semibold">Popis</h2>
            <p class="mt-3 leading-7 text-gray-700"><?= nl2br($esc($property->description)) ?></p>
        </div>
    </section>
</main>
