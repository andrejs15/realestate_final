<?php

namespace App\Controllers;

use App\Models\AccessibilityFeature;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\StyleOfHome;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/** AI-assisted migration of the Laravel home/index action to Vaííčko. */
class HomeController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->html([
            'title' => 'Ponuka nehnuteľností',
            'properties' => Property::getAll(null, [], 'id DESC'),
            'propertyTypes' => PropertyType::getAll(null, [], 'name ASC'),
            'styleOfHomes' => StyleOfHome::getAll(null, [], 'name ASC'),
            'accessibilityFeatures' => AccessibilityFeature::getAll(null, [], 'name ASC'),
        ]);
    }
}
