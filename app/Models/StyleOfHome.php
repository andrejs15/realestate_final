<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StyleOfHome extends Model
{
    protected $fillable = ['name'];

    public function properties() {
        return $this->hasMany(Property::class);
    }
}
