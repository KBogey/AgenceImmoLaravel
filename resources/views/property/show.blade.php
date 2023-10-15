@extends('base')

@section('title', $property->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div id="carousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px">
                    <div class="carousel-inner">
                        @foreach($property->images as $k => $image)
                            <div class="carousel-item {{ $k === 0 ? 'active' : '' }}">
                                <img src="{{ $image->getImageUrl(800, 530) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-preview="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-4">
                <h1>{{ $property->title }}</h1>
                <h2>{{ $property->rooms }} pièces - {{ $property->surface }} m&#178;</h2>

                <div class="text-primary fw-bold" style="font-size: 4rem">
                    {{ number_format($property->price, thousands_separator: '') }} €
                </div>
            </div>
        </div>


        <div class="my-4">
            <div class="mb-4">
                <h3>Description</h3>
                <p class="mt-4">{!! nl2br($property->description) !!}</p>
            </div>
            <div class="row">
                <div class="col-8">
                    <h3>Caractéristiques</h3>
                    <table class="table table-striped mt-4">
                        <tr>
                            <td>Localisation</td>
                            <td>
                                {{ $property->address }}<br>
                                {{ $property->city }} ({{ $property->postal_code }})
                            </td>
                        </tr>
                        <tr>
                            <td>Surface habitable</td>
                            <td>{{ $property->surface }} m&#178;</td>
                        </tr>
                        <tr>
                            <td>Nombre de pièces</td>
                            <td>{{ $property->rooms }}</td>
                        </tr>
                        <tr>
                            <td>Nombre de chambres</td>
                            <td>{{ $property->bedrooms }}</td>
                        </tr>
                        <tr>
                            <td>Étage</td>
                            <td>
                                @if( $property->floor === 0)
                                    Rez-de-chaussée
                                @else
                                {{ $property->floor }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-4 mb-4">
                    <h3>Spécificités</h3>
                    <ul class="list-group mt-4">
                        @foreach($property->options as $option)
                            <li class="list-group-item">{{ $option->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <hr class="text-warning-emphasis">

        <div class="my-4 d-flex justify-content-center">
            <div class="bg-light p-3 rounded border-0">
                <h4>Intéressé par ce bien ?</h4>
                @include('shared.flash')
                <form action="{{ route('property.contact', $property) }}" method="post" class="vstack gap-3">
                    @csrf
                    <div class="row">
                        @include('shared.input', [ 'class' => 'col', 'name' => 'firstname',  'label' => 'Prénom', 'value' => 'John' ])
                        @include('shared.input', [ 'class' => 'col', 'name' => 'lastname',  'label' => 'Nom', 'value' => 'Doe' ])
                    </div>
                    <div class="row">
                        @include('shared.input', [ 'class' => 'col', 'name' => 'phone',  'label' => 'Téléphone', 'value' => '06 00 00 00 00' ])
                        @include('shared.input', [ 'type' => 'email', 'class' => 'col', 'name' => 'email',  'label' => 'Email', 'value' => 'john@doepublic.fr' ])
                    </div>
                    @include('shared.input', [ 'type' => 'textarea', 'class' => 'col', 'name' => 'message',  'label' => 'Votre message', 'value' => 'Votre message' ])
                    <div class="text-end">
                        <button class="btn btn-outline-primary">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
