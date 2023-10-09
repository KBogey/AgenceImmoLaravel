@extends('base')

@section('title', 'tous nos biens')

@section('content')
    <style>
        ::placeholder {
            color: rgb(102, 77, 3, 0.8) !important;
        }
    </style>
    <div class="d-flex">
        <div class="container col-3">
                <form action="" method="get" class="container my-2 text-end">
                    <input type="number" placeholder="Surface minimum" class="form-control mb-2 text-warning-emphasis" name="surface" value="{{ $input['surface'] ?? '' }}">
                    <input type="number" placeholder="Nombre de pièces min" class="form-control mb-2" name="rooms" value="{{ $input['rooms'] ?? '' }}">
                    <input type="number" placeholder="Budget max" class="form-control mb-2" name="price" value="{{ $input['price'] ?? '' }}">
                    <input placeholder="Mot clef" class="form-control mb-2" name="title" value="{{ $input['title'] ?? '' }}">
                    <button class="btn btn-primary btn-sm flex-grow-0">
                        Rechercher
                    </button>
                </form>

        </div>


        <div class="container">
            <div class="row">

                @forelse($properties as $property)
                    <div class="col-4">
                        @include('property.card')
                    </div>
                @empty
                <div class="col text-warning-emphasis text-center">
                    Aucun bien ne correspond à votre recherche.
                </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="container my-4">
        {{ $properties->links() }}
    </div>

@endsection
