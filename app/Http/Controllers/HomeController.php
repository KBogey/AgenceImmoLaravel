<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::recent()->with('images')->limit(4)->get();
        dump($properties);
        return view('home', [
            'properties' => $properties
        ]);
    }
}
