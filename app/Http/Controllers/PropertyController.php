<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\AccessibilityFeature;
use Illuminate\Http\Request;


class PropertyController extends Controller
{
    public function index()
    {
        $title = 'Ponuka nehnuteľností';

        $properties = Property::all();
        $propertyTypes = PropertyType::orderBy('id')->get();
        $accessibilityFeatures = AccessibilityFeature::orderBy('id')->get();

        return view('home', compact('title', 'properties', 'propertyTypes', 'accessibilityFeatures'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $property = new Property;
        $property->title = $request->title;
        $property->price = $request->price;
        $property->location = $request->location;

        $property->save();

        return redirect(route('home'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        $propertyTypes = PropertyType::orderBy('id')->get();

        return view('properties.show', compact('property', 'propertyTypes'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
