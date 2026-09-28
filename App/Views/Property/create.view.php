<?php
/** @var \App\Models\PropertyType[] $propertyTypes */
/** @var \App\Models\StyleOfHome[] $styleOfHomes */
/** @var \App\Models\AccessibilityFeature[] $accessibilityFeatures */
/* AI-assisted migration of resources/views/properties/create.blade.php. */
$view->setLayout('home');
$old = $old ?? [];
$errors = $errors ?? [];
$esc = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$error = static fn(string $key) => $errors[$key] ?? null;
$selectedFeatures = array_map('intval', (array)($old['accessibility_features'] ?? []));
?>
<div class="fixed inset-0 z-10 flex items-center justify-center bg-gray-900/40 backdrop-blur-xs">
    <div class="max-h-[95vh] overflow-auto relative w-full max-w-[50vw] rounded-2xl bg-white p-4 pt-0 shadow-2xl">
        <a href="<?= $link->url('home.index') ?>" class="absolute no-underline top-0 right-2 text-3xl hover:!text-black !text-gray-500">×</a>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-center mb-6">Pridať novú nehnuteľnosť</h1>
            <p class="mt-2 text-sm text-gray-600">Vyplňte základné informácie o nehnuteľnosti</p>
            <div class="border-b border-gray-500"></div>
        </div>

        <?php if ($error('_token')) { ?><p class="mb-4 text-sm text-red-600"><?= $esc($error('_token')) ?></p><?php } ?>

        <form action="<?= $link->url('property.store') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?= $esc($csrfToken) ?>">

            <div class="mb-5">
                <label for="title" class="mb-2 block font-medium text-black">Názov</label>
                <input type="text" id="title" name="title" value="<?= $esc($old['title'] ?? '') ?>" required maxlength="255" class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-gray-500 transition duration-300">
                <?php if ($error('title')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('title')) ?></p><?php } ?>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="price" class="mb-2 block text-black">Cena</label>
                    <input type="number" id="price" name="price" value="<?= $esc($old['price'] ?? '') ?>" required min="0" step="1" class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-gray-500 transition duration-300">
                    <?php if ($error('price')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('price')) ?></p><?php } ?>
                </div>
                <div>
                    <label for="location" class="mb-2 block text-black">Lokalita</label>
                    <input type="text" id="location" name="location" value="<?= $esc($old['location'] ?? '') ?>" required maxlength="255" class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-gray-500 transition duration-300">
                    <?php if ($error('location')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('location')) ?></p><?php } ?>
                </div>
            </div>

            <div class="mt-5">
                <label for="description" class="block mb-2">Popis</label>
                <textarea id="description" name="description" rows="5" required maxlength="2000" class="w-full resize-none box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-gray-500 transition duration-300"><?= $esc($old['description'] ?? '') ?></textarea>
                <div class="-mt-1 text-right text-sm text-gray-400 opacity-70"><span id="description-counter">2000</span> znakov zostáva</div>
                <?php if ($error('description')) { ?><p class="text-red-600 text-sm"><?= $esc($error('description')) ?></p><?php } ?>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="property_type_id" class="mb-2 block font-medium text-gray-700">Typ nehnuteľnosti</label>
                    <select id="property_type_id" name="property_type_id" required class="!w-full !max-w-none !rounded-md !border !border-gray-300 !px-4 !py-2 transition duration-300 ease-out focus:border-black focus:outline-none focus:ring-1 focus:ring-black">
                        <option value="">Vyberte typ</option>
                        <?php foreach ($propertyTypes as $propertyType) { ?>
                            <option value="<?= (int)$propertyType->id ?>" <?= (string)($old['property_type_id'] ?? '') === (string)$propertyType->id ? 'selected' : '' ?>><?= $esc($propertyType->name) ?></option>
                        <?php } ?>
                    </select>
                    <?php if ($error('property_type_id')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('property_type_id')) ?></p><?php } ?>
                </div>
                <div>
                    <label for="style_of_home_id" class="mb-2 block font-medium text-gray-700">Štýl nehnuteľnosti</label>
                    <select id="style_of_home_id" name="style_of_home_id" required class="!w-full !max-w-none !rounded-md !border !border-gray-300 !px-4 !py-2 transition duration-300 ease-out focus:border-black focus:outline-none focus:ring-1 focus:ring-black">
                        <option value="">Vyberte štýl</option>
                        <?php foreach ($styleOfHomes as $styleOfHome) { ?>
                            <option value="<?= (int)$styleOfHome->id ?>" <?= (string)($old['style_of_home_id'] ?? '') === (string)$styleOfHome->id ? 'selected' : '' ?>><?= $esc($styleOfHome->name) ?></option>
                        <?php } ?>
                    </select>
                    <?php if ($error('style_of_home_id')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('style_of_home_id')) ?></p><?php } ?>
                </div>
            </div>

            <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-3">
                <?php foreach ([['rooms', 'Počet izieb', 1], ['baths', 'Počet kúpeľní', 0], ['size', 'Rozloha m²', 1]] as [$key, $label, $min]) { ?>
                    <div>
                        <label for="<?= $key ?>" class="mb-2 block font-medium text-gray-700"><?= $label ?></label>
                        <input type="number" id="<?= $key ?>" name="<?= $key ?>" value="<?= $esc($old[$key] ?? '') ?>" required min="<?= $min ?>" step="1" class="w-full box-border rounded-md border border-gray-300 px-4 py-2 focus:outline-none focus:ring-1 focus:ring-gray-500 transition duration-300">
                        <?php if ($error($key)) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error($key)) ?></p><?php } ?>
                    </div>
                <?php } ?>
            </div>

            <div class="mt-5">
                <p class="mb-2 font-medium text-gray-700">Accessibility features</p>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($accessibilityFeatures as $feature) { ?>
                        <label class="cursor-pointer">
                            <input type="checkbox" name="accessibility_features[]" value="<?= (int)$feature->id ?>" class="peer sr-only" <?= in_array((int)$feature->id, $selectedFeatures, true) ? 'checked' : '' ?>>
                            <span class="inline-flex rounded-full border border-gray-300 px-4 py-2 text-sm text-gray-600 transition duration-200 hover:border-gray-500 peer-checked:border-black peer-checked:bg-black peer-checked:text-white"><?= $esc($feature->name) ?></span>
                        </label>
                    <?php } ?>
                </div>
                <?php if ($error('accessibility_features')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('accessibility_features')) ?></p><?php } ?>
            </div>

            <div class="mt-5">
                <label class="mb-2 block font-medium text-gray-700">Fotografie nehnuteľnosti</label>
                <label for="images" class="flex cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-4 py-6 text-center transition duration-200 hover:border-gray-500 hover:bg-gray-100">
                    <span class="text-sm font-medium text-gray-700">Kliknite pre výber fotografií</span>
                    <span class="mt-1 text-xs text-gray-400">JPG, PNG alebo WEBP, max. 8 fotografií</span>
                    <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/webp" multiple class="sr-only">
                </label>
                <div class="mt-3 grid grid-cols-2 gap-3 border border-gray-400 sm:grid-cols-3 md:grid-cols-4 invisible" id="image-preview"></div>
                <?php if ($error('images')) { ?><p class="mt-1 text-sm text-red-600"><?= $esc($error('images')) ?></p><?php } ?>
            </div>

            <div class="flex justify-end mt-5">
                <button type="submit" class="rounded-md bg-blue-600 px-5 py-2 text-base font-semibold text-white transition duration-200 hover:bg-blue-700 border border-gray-300 cursor-pointer">Uložiť</button>
            </div>
        </form>
    </div>
</div>
