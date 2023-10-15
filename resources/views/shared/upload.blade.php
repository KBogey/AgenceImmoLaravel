@php
    $class ??= null;
    $multiple ??= false;
@endphp
<div @class(["form-group", $class])>
    <label for="{{ $name  }}">{{ $label }}</label>
    <input class="form-control @if($multiple) multiple @endif @error($name) is-invalid @enderror" type="file" id="{{ $name  }}" name="{{ $name . ($multiple ? '[]' : '')}}"/>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
