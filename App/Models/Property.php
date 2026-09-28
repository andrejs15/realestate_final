<?php

namespace App\Models;

use Framework\Core\Model;

/**
 * AI-assisted migration of the original Laravel Property model.
 * Relationships use Vaííčko's related-entity helpers and prepared statements.
 */
class Property extends Model
{
    protected static ?string $tableName = 'properties';

    public ?int $id = null;
    public ?string $title = null;
    public ?int $price = null;
    public ?string $location = null;
    public ?string $description = null;
    public ?int $rooms = null;
    public ?int $baths = null;
    public ?int $size = null;
    public ?int $propertyTypeId = null;
    public ?int $styleOfHomeId = null;

    public function propertyType(): ?PropertyType
    {
        return $this->getOneRelated(PropertyType::class);
    }

    public function styleOfHome(): ?StyleOfHome
    {
        return $this->getOneRelated(StyleOfHome::class);
    }

    /** @return PropertyImage[] */
    public function images(): array
    {
        return $this->getAllRelated(PropertyImage::class, 'property_id');
    }

    public function mainImage(): ?PropertyImage
    {
        if ($this->id === null) {
            return null;
        }

        $images = PropertyImage::getAll(
            'property_id = ? AND is_main_image = ?',
            [$this->id, 1],
            'id ASC',
            1
        );

        return $images[0] ?? null;
    }

    /** @return AccessibilityFeature[] */
    public function accessibilityFeatures(): array
    {
        if ($this->id === null) {
            return [];
        }

        return AccessibilityFeature::getAll(
            'id IN (SELECT accessibility_feature_id FROM accessibility_feature_property WHERE property_id = ?)',
            [$this->id],
            'name ASC'
        );
    }

    public function syncAccessibilityFeatures(array $featureIds): void
    {
        if ($this->id === null) {
            return;
        }

        self::executeRawSQL(
            'DELETE FROM accessibility_feature_property WHERE property_id = ?',
            [$this->id]
        );

        foreach (array_unique(array_map('intval', $featureIds)) as $featureId) {
            self::executeRawSQL(
                'INSERT INTO accessibility_feature_property (property_id, accessibility_feature_id) VALUES (?, ?)',
                [$this->id, $featureId]
            );
        }
    }
}
