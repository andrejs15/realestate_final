<?php

namespace App\Models;

use Framework\Core\Model;

/** AI-assisted migration of the original Laravel model. */
class PropertyType extends Model
{
    protected static ?string $tableName = 'property_types';

    public ?int $id = null;
    public ?string $name = null;
}
