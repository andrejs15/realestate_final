<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $title = 'Ponuka nehnuteľností';

        $properties = [
            [
                'title' => 'Moderný byt v centre',
                'price' => 185000,
                'location' => 'Bratislava',
            ],
            [
                'title' => 'Rodinný dom so záhradou',
                'price' => 289000,
                'location' => 'Žilina',
            ],
            [
                'title' => 'Malý apartmán',
                'price' => 99000,
                'location' => 'Košice',
            ],
        ];

        return view('home', compact('title', 'properties'));
    }
}
