@extends('admin.admin')

@section('title', $property->exists ? "Editer un bien" : "Créer un bien")

@section('content')
    <h1>@yield('title')</h1>
    <form action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', ['property' => $property] ) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method($property->exists ? 'put' : 'post')

        <div class="row">
            <div class="col" style="flex: 100">
                <div class="row">
                    @include('shared.input', [ 'class' => 'col', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title, 'autofocus' ])
                    <div class="row col">
                        @include('shared.input', [ 'class' => 'col', 'name' => 'surface', 'value' => $property->surface ])
                        @include('shared.input', [ 'class' => 'col', 'name' => 'price', 'label' => 'Prix', 'value' => $property->price ])
                    </div>
                </div>

                <div class="row">
                    @include('shared.input', [ 'type'=> 'textarea', 'class' => 'col', 'name' => 'description', 'value' => $property->description ])
                </div>

                <div class="row">
                    @include('shared.input', [ 'class' => 'col', 'name' => 'rooms', 'value' => $property->rooms, 'label' => 'Nb de pièces' ])
                    @include('shared.input', [ 'class' => 'col', 'name' => 'bedrooms', 'value' => $property->bedrooms, 'label' => 'Nb de chambres' ])
                    @include('shared.input', [ 'class' => 'col', 'name' => 'floor', 'value' => $property->floor, 'label' => 'Étage' ])
                </div>

                <div class="row">
                    @include('shared.input', [ 'class' => 'col', 'name' => 'address', 'value' => $property->address, 'label' => 'Adresse' ])
                    @include('shared.input', [ 'class' => 'col', 'name' => 'postal_code', 'value' => $property->postal_code, 'label' => 'Code postal' ])
                    @include('shared.input', [ 'class' => 'col', 'name' => 'city', 'value' => $property->city, 'label' => 'Commune' ])
                </div>

                <div class="row mt-1 mb-1">
                    @include('shared.select', [ 'name' => 'options', 'value' => $property->options()->pluck('id'), 'label' => 'Sélection des options', 'multiple' => true, 'options' => $options ])
                    <div class="m-1">@include('shared.checkbox', [ 'name' => 'sold', 'value' => $property->sold, 'label' => 'Vendu' ])</div>
                </div>
                <div>
                    <button class="btn btn-primary">
                        @if($property->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>
            </div>
            <div class="col vstack gap-2" style="flex: 25">
                @foreach($property->images as $image)
                    <div id="image{{ $image->id }}" class="position-relative">
                        <img src="{{ $image->getImageUrl() }}" alt="" class="w-100 d-block">
                        <button type="button" class="btn btn-danger position-absolute bottom-0 w-100 start-0"
                                hx-delete="{{ route('admin.image.destroy', $image) }}"
                                hx-target="#image{{ $image->id }}"
                                hx-swap="delete">
                            <span class="htmx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Supprimer
                        </button>
                    </div>
                @endforeach
                @include('shared.upload', [ 'name' => 'images', 'label' => 'Images', 'multiple' => true ])
            </div>
        </div>
    </form>
@endsection
