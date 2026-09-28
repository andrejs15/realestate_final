<?php
/** @var \App\Models\Property[] $properties */
/** @var \App\Models\PropertyType[] $propertyTypes */
/** @var \App\Models\StyleOfHome[] $styleOfHomes */
/** @var \App\Models\AccessibilityFeature[] $accessibilityFeatures */
/* AI-assisted migration of the original Laravel home page. */
$view->setLayout('home');
$esc = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<main class="flex">
    <aside>
        <div class="aside-header">
            <h3>Filters</h3>
            <div class="button-field">
                <button class="mobile-only" id="toggle-filters">Show filters</button>
                <button type="button" class="reset-form" id="reset-button">Reset filters</button>
                <span>5</span>
            </div>
        </div>

        <div class="checkbox-wrapper" id="filters">
            <form id="filter" action="<?= $link->url('home.index') ?>" method="get">
                <div class="form-section flex">
                    <h3>Property type</h3>
                    <?php foreach ($propertyTypes as $type) { ?>
                        <label>
                            <input type="checkbox" name="property_type[]" value="<?= (int)$type->id ?>">
                            <?= $esc($type->name) ?>
                        </label>
                    <?php } ?>
                </div>

                <div class="form-section flex">
                    <h3>Style of home</h3>
                    <?php foreach ($styleOfHomes as $style) { ?>
                        <label>
                            <input type="checkbox" name="style_of_home[]" value="<?= (int)$style->id ?>">
                            <?= $esc($style->name) ?>
                        </label>
                    <?php } ?>
                </div>

                <div class="form-section form-section-select">
                    <div class="titles"><h3>Min. price</h3><h3>Max. price</h3></div>
                    <div class="selects">
                        <select name="min_price"><option value="">Any</option><option>500000</option><option>1000000</option><option>1500000</option></select>
                        <select name="max_price"><option value="">Any</option><option>500000</option><option>1000000</option><option>1500000</option></select>
                    </div>
                </div>

                <div class="form-section form-section-select">
                    <div class="titles"><h3>Bedroom</h3><h3>Bathroom</h3></div>
                    <div class="selects">
                        <select name="rooms"><option value="">Any</option><option>1</option><option>2</option><option>3</option><option>4</option></select>
                        <select name="baths"><option value="">Any</option><option>1</option><option>2</option><option>3</option><option>4</option></select>
                    </div>
                </div>

                <div class="form-section flex">
                    <h3>Accessibility Features</h3>
                    <?php foreach ($accessibilityFeatures as $feature) { ?>
                        <label>
                            <input type="checkbox" name="accessibility[]" value="<?= (int)$feature->id ?>">
                            <?= $esc($feature->name) ?>
                        </label>
                    <?php } ?>
                </div>
            </form>
        </div>
    </aside>

    <section class="main-section">
        <div class="main-header flex">
            <h3>Showing <?= count($properties) ?> search results</h3>
            <div class="sort-container flex">
                <span class="sort-label">Sort by:</span>
                <select id="sort-select">
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Popular</option>
                </select>
            </div>
        </div>

        <?php foreach (array_chunk($properties, 2) as $propertyGroup) { ?>
            <div class="main-image-section flex">
                <div class="image-box-wrapper flex">
                    <?php foreach ($propertyGroup as $house) {
                        $mainImage = $house->mainImage();
                        $imagePath = $mainImage?->imagePath ?? 'img/house1.png';
                    ?>
                        <a href="<?= $link->url('property.show', ['id' => $house->id]) ?>" class="group block !text-black no-underline">
                            <div class="main-image-box group transition-all cursor-pointer duration-300 ease-out group-hover:scale-[1.03] group-hover:-translate-y-1 group-hover:shadow-2xl group-hover:ring-2">
                                <div class="h-60 overflow-hidden">
                                    <img src="<?= $link->asset($imagePath) ?>" alt="<?= $esc($house->title) ?>" class="h-full w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105">
                                </div>
                                <p>€<?= number_format((int)$house->price, 0, ',', ' ') ?></p>
                                <span><?= $esc($house->title) ?>, <?= $esc($house->location) ?></span>
                                <div class="rooms">
                                    <i class="fa-solid fa-bath"></i> <span><?= (int)$house->baths ?></span>
                                    <i class="fa-solid fa-bed"></i> <span><?= (int)$house->rooms ?></span>
                                    <i class="fa-solid fa-arrows-alt"></i> <span><?= (int)$house->size ?> m²</span>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </section>
</main>
