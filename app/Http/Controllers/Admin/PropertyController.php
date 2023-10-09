<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Property;
use App\Models\Option;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    public function create()
    {
        $property = new Property();
        $property->fill([
            'title' => "Cheesy life",
            'surface' => 40,
            'description' => "I love cheese, especially cottage cheese emmental. Swiss say cheese cow when the cheese comes out everybody's happy blue castello red leicester cheddar cottage cheese. Goat.",
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'postal_code' => 34000,
            'city' => 'Montpellier',
            'sold' => false
        ]);
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name', 'id' ),
        ]);
    }

    public function store(PropertyFormRequest $request)
    {

        $property = Property::create($request->validated());
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'L\'annonce a été publiée');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.form', [
           'property' =>  $property,
            'options' => Option::pluck('name', 'id' ),
        ]);
    }

    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->options()->sync($request->validated('options'));
        $property->update($request->validated());
        return to_route('admin.property.index')->with('success', 'L\'annonce a été modifiée');

    }

    public function destroy(Property $property)
    {
        $property->delete();
        return to_route('admin.property.index')->with('success', 'L\'annonce a été supprimée');
    }
}
