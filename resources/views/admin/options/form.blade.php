@extends('admin.admin')

@section('title', $option->exists ? "Editer une option" : "Créer une option")

@section('content')
    <h1>@yield('title')</h1>
    <form action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', ['option' => $option] ) }}" method="post">

        @csrf
        @method($option->exists ? 'put' : 'post')

        @include('shared.input', [ 'name' => 'name', 'value' => $option->name, 'label' => 'Nom de l\'option', 'autofocus' => true ])

        <div>
            <button class="btn btn-primary">
                @if($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>
@endsection
