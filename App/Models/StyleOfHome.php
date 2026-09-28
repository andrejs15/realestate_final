<?php

namespace App\Models;

use Framework\Core\Model;

/** AI-assisted migration of the original Laravel model. */
class StyleOfHome extends Model
{
    protected static ?string $tableName = 'style_of_homes';

    public ?int $id = null;
    public ?string $name = null;
}
