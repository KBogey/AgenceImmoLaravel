@extends('base')

@section('content')
    <div class="bg-light p-5 mb-5 text-center w-100">
        <div class="container">
            <h1>Agence des pins</h1>
            <p class="text-start">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt esse incidunt minima numquam soluta!
                Commodi dicta eos harum ipsam molestias nisi voluptate. At facere, ipsam iure mollitia nam nobis
                reprehenderit.
            </p>
        </div>
    </div>
    <div class="container">
        <h2 class="text-dark-emphasis">Nos derniers biens</h2>
        <div class="row">
            @foreach($properties as $property)
                <div class="col">
                    @include('property.card')
                </div>
            @endforeach
        </div>
    </div>
@endsection
