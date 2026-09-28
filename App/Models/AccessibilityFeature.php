<?php

namespace App\Models;

use Framework\Core\Model;

/** AI-assisted migration of the original Laravel model. */
class AccessibilityFeature extends Model
{
    protected static ?string $tableName = 'accessibility_features';

    public ?int $id = null;
    public ?string $name = null;
}
