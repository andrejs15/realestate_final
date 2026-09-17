<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function propertyType() {
        return $this->belongsTo(PropertyType::class);
    }

    public function styleOfHome() {
        return $this->belongsTo(StyleOfHome::class);
    }

    public function images() {
        return $this->hasMany(PropertyImage::class);
    }

    public function mainImage() {
        return $this->hasOne(PropertyImage::class)->where('isMainImage', true);
    }
    public function accessibilityFeatures()
    {
        return $this->belongsToMany(AccessibilityFeature::class);
    }
}
