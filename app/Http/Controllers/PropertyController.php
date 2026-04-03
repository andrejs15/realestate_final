<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $title = 'Ponuka nehnuteľností';

        $properties = Property::all();

        return view('home', compact('title', 'properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $property = new Property();
        $property->title = $request->title;
        $property->price = $request->price;
        $property->location = $request->location;

        $property->save();
        return redirect(route('home'));
    }

    public function show($id)
    {

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
