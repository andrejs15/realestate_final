<?php

namespace App\Controllers;

use App\Models\AccessibilityFeature;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\StyleOfHome;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\UploadedFile;

/**
 * AI-assisted migration of the existing Laravel PropertyController to Vaííčko.
 * Only functionality already present in the Laravel branch is migrated here: read, create and image upload.
 */
class PropertyController extends BaseController
{
    private const CSRF_SESSION_KEY = 'property.form.csrf';
    private const MAX_IMAGES = 8;
    private const MAX_IMAGE_SIZE = 5 * 1024 * 1024;

    public function index(Request $request): Response
    {
        return $this->redirect($this->url('home.index'));
    }

    public function show(Request $request): Response
    {
        $id = filter_var($request->value('id'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($id === false) {
            throw new HttpException(404);
        }

        $property = Property::getOne($id);
        if ($property === null) {
            throw new HttpException(404);
        }

        return $this->html([
            'property' => $property,
            'images' => $property->images(),
            'propertyType' => $property->propertyType(),
            'styleOfHome' => $property->styleOfHome(),
            'accessibilityFeatures' => $property->accessibilityFeatures(),
        ]);
    }

    public function create(Request $request): Response
    {
        return $this->html($this->formViewData([], []));
    }

    public function store(Request $request): Response
    {
        if (!$request->isPost()) {
            return $this->redirect($this->url('property.create'));
        }

        $old = $request->post();
        $files = $this->uploadedImages();
        $errors = $this->validateInput($old, $files);

        if (!$this->validCsrfToken((string)($request->post('_token') ?? ''))) {
            $errors['_token'] = 'Platnosť formulára vypršala. Obnovte stránku a skúste to znova.';
        }

        if ($errors !== []) {
            return $this->html($this->formViewData($old, $errors), 'create');
        }

        $property = new Property();
        $property->title = trim((string)$old['title']);
        $property->price = (int)$old['price'];
        $property->location = trim((string)$old['location']);
        $property->description = trim((string)$old['description']);
        $property->rooms = (int)$old['rooms'];
        $property->baths = (int)$old['baths'];
        $property->size = (int)$old['size'];
        $property->propertyTypeId = (int)$old['property_type_id'];
        $property->styleOfHomeId = (int)$old['style_of_home_id'];
        $property->save();

        $property->syncAccessibilityFeatures((array)($old['accessibility_features'] ?? []));
        $this->storeImages($property, $files);

        return $this->redirect($this->url('home.index'));
    }

    private function formViewData(array $old, array $errors): array
    {
        return [
            'propertyTypes' => PropertyType::getAll(null, [], 'name ASC'),
            'styleOfHomes' => StyleOfHome::getAll(null, [], 'name ASC'),
            'accessibilityFeatures' => AccessibilityFeature::getAll(null, [], 'name ASC'),
            'old' => $old,
            'errors' => $errors,
            'csrfToken' => $this->csrfToken(),
        ];
    }

    private function validateInput(array $data, array $files): array
    {
        $errors = [];

        $title = trim((string)($data['title'] ?? ''));
        if ($title === '' || strlen($title) > 255) {
            $errors['title'] = 'Názov je povinný a môže mať najviac 255 znakov.';
        }

        $location = trim((string)($data['location'] ?? ''));
        if ($location === '' || strlen($location) > 255) {
            $errors['location'] = 'Lokalita je povinná a môže mať najviac 255 znakov.';
        }

        $description = trim((string)($data['description'] ?? ''));
        if ($description === '' || strlen($description) > 2000) {
            $errors['description'] = 'Popis je povinný a môže mať najviac 2000 znakov.';
        }

        $this->validateInteger($data, 'price', 0, $errors, 'Cena');
        $this->validateInteger($data, 'rooms', 1, $errors, 'Počet izieb');
        $this->validateInteger($data, 'baths', 0, $errors, 'Počet kúpeľní');
        $this->validateInteger($data, 'size', 1, $errors, 'Rozloha');

        $propertyTypeId = filter_var($data['property_type_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($propertyTypeId === false || PropertyType::getOne($propertyTypeId) === null) {
            $errors['property_type_id'] = 'Vyberte platný typ nehnuteľnosti.';
        }

        $styleId = filter_var($data['style_of_home_id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($styleId === false || StyleOfHome::getOne($styleId) === null) {
            $errors['style_of_home_id'] = 'Vyberte platný štýl nehnuteľnosti.';
        }

        foreach ((array)($data['accessibility_features'] ?? []) as $featureId) {
            $featureId = filter_var($featureId, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
            if ($featureId === false || AccessibilityFeature::getOne($featureId) === null) {
                $errors['accessibility_features'] = 'Jedna z vybraných accessibility features nie je platná.';
                break;
            }
        }

        if (count($files) > self::MAX_IMAGES) {
            $errors['images'] = 'Môžete nahrať najviac 8 fotografií.';
        }

        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        foreach ($files as $file) {
            if (!$file->isOk()) {
                $errors['images'] = $file->getErrorMessage() ?? 'Fotografiu sa nepodarilo nahrať.';
                break;
            }
            if ($file->getSize() > self::MAX_IMAGE_SIZE) {
                $errors['images'] = 'Každá fotografia môže mať najviac 5 MB.';
                break;
            }
            $mime = $finfo->file($file->getFileTempPath());
            if (!in_array($mime, $allowedMimes, true)) {
                $errors['images'] = 'Povolené sú iba JPG, PNG a WEBP fotografie.';
                break;
            }
        }

        return $errors;
    }

    private function validateInteger(array $data, string $key, int $min, array &$errors, string $label): void
    {
        $value = filter_var($data[$key] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => $min]]);
        if ($value === false) {
            $errors[$key] = $label . ' musí byť celé číslo minimálne ' . $min . '.';
        }
    }

    /** @return UploadedFile[] */
    private function uploadedImages(): array
    {
        if (!isset($_FILES['images'])) {
            return [];
        }

        $raw = $_FILES['images'];
        if (!is_array($raw['name'])) {
            return [(new UploadedFile($raw))];
        }

        $files = [];
        foreach (array_keys($raw['name']) as $index) {
            $entry = [
                'name' => $raw['name'][$index],
                'type' => $raw['type'][$index],
                'tmp_name' => $raw['tmp_name'][$index],
                'error' => $raw['error'][$index],
                'size' => $raw['size'][$index],
            ];

            if ((int)$entry['error'] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            $files[] = new UploadedFile($entry);
        }

        return $files;
    }

    /** @param UploadedFile[] $files */
    private function storeImages(Property $property, array $files): void
    {
        if ($files === []) {
            return;
        }

        $directory = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR
            . 'uploads' . DIRECTORY_SEPARATOR . 'property-images' . DIRECTORY_SEPARATOR;

        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new \RuntimeException('Nepodarilo sa vytvoriť priečinok pre fotografie.');
        }

        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];
        $finfo = new \finfo(FILEINFO_MIME_TYPE);

        foreach ($files as $index => $file) {
            $mime = $finfo->file($file->getFileTempPath());
            $extension = $extensions[$mime];
            $fileName = bin2hex(random_bytes(16)) . '.' . $extension;

            if (!$file->store($directory . $fileName)) {
                throw new \RuntimeException('Fotografiu sa nepodarilo uložiť.');
            }

            $propertyImage = new PropertyImage();
            $propertyImage->propertyId = $property->id;
            $propertyImage->imagePath = 'uploads/property-images/' . $fileName;
            $propertyImage->isMainImage = $index === 0 ? 1 : 0;
            $propertyImage->save();
        }
    }

    private function csrfToken(): string
    {
        $session = $this->app->getSession();
        $token = $session->get(self::CSRF_SESSION_KEY);
        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            $session->set(self::CSRF_SESSION_KEY, $token);
        }
        return $token;
    }

    private function validCsrfToken(string $token): bool
    {
        $stored = $this->app->getSession()->get(self::CSRF_SESSION_KEY, '');
        return is_string($stored) && $stored !== '' && hash_equals($stored, $token);
    }
}
