<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Image;
use App\Models\Property;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index', [
            'properties' => Property::withTrashed()->orderBy('created_at', 'desc')->paginate(25)
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
        $property->attachFiles($request->validated('images'));
        return to_route('admin.property.index')->with('success', 'L\'annonce a été modifiée');

    }

    public function destroy(Property $property)
    {
        // permet de supprimer les images dans le dossier storage lorsque au'un bien immo est supprimer
        Image::destroy(
            $property->images()->pluck('id')
        );

        // permet de supprimer les images une à une lorsque l'on modifie une annonce
        $property->delete();
        return to_route('admin.property.index')->with('success', 'L\'annonce a été supprimée');
    }

    public function forcedelete(Property $property)
    {
       $property->forceDelete();
       return to_route('admin.property.index')->with('success', 'L\'annonce a été définitivement supprimée');
    }

    public function restore(Property $property)
    {
        $property->restore();
        return to_route('admin.properties.index')->with('success', 'L\'annonce a été republiée');
    }


}
