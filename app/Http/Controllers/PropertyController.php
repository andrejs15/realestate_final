<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\AccessibilityFeature;
use App\Models\StyleOfHome;
use App\Models\PropertyImage;
use Illuminate\Http\Request;


class PropertyController extends Controller
{
    public function index()
    {
        $title = 'Ponuka nehnuteľností';

        $properties = Property::with('mainImage')->get();
        $propertyTypes = PropertyType::orderBy('id')->get();
        $accessibilityFeatures = AccessibilityFeature::orderBy('id')->get();

        return view('home', compact('title', 'properties', 'propertyTypes', 'accessibilityFeatures'));
    }

    public function create()
    {
        $propertyTypes = PropertyType::orderBy('name')->get();
        $styleOfHomes = StyleOfHome::orderBy('name')->get();
        $accessibilityFeatures = AccessibilityFeature::orderBy('name')->get();

        return view('properties.create', compact('propertyTypes', 'styleOfHomes', 'accessibilityFeatures'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'rooms' => 'required|integer|min:1',
            'baths' => 'required|integer|min:0',
            'size' => 'required|integer|min:1',

            'property_type_id' => 'required|exists:property_types,id',
            'style_of_home_id' => 'required|exists:style_of_homes,id',

            'accessibility_features' => 'nullable|array',
            'accessibility_features.*' => 'exists:accessibility_features,id',
            'images' => 'nullable|array|max:8',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $property = new Property;

        $property->title = $validatedData['title'];
        $property->price = $validatedData['price'];
        $property->location = $validatedData['location'];
        $property->description = $validatedData['description'];
        $property->rooms = $validatedData['rooms'];
        $property->baths = $validatedData['baths'];
        $property->size = $validatedData['size'];

        $property->property_type_id = $validatedData['property_type_id'];
        $property->style_of_home_id = $validatedData['style_of_home_id'];

        $property->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('property-images', 'public');
                $propertyImage = new PropertyImage();
                $propertyImage->imagePath = $path;
                $propertyImage->isMainImage = $index === 0;

                $property->images()->save($propertyImage);
            }
        }

        $property->accessibilityFeatures()->sync($validatedData['accessibility_features'] ?? []);

        return redirect(route('home'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        $propertyTypes = PropertyType::orderBy('id')->get();
        $accessibilityFeatures = AccessibilityFeature::orderBy('name')->get();

        return view('properties.show', compact('property', 'propertyTypes', 'accessibilityFeatures'));
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
