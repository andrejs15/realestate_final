<?php

namespace App\Models;

use Framework\Core\Model;

/** AI-assisted migration of the original Laravel model. */
class PropertyImage extends Model
{
    protected static ?string $tableName = 'property_images';

    public ?int $id = null;
    public ?int $propertyId = null;
    public ?string $imagePath = null;
    public ?int $isMainImage = 0;
}
