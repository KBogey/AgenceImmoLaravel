<div class="card my-2">
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property]) }}" class="text-info-emphasis">{{ $property->title }}</a>
        </h5>
        <p class="card-text text-primary-emphasis">{{ $property->surface }}m&#178; - {{ $property->city }} {{ $property->postal_code }}</p>
        <div class=" text-info-emphasis" style="font-size: 1.4rem">
            {{ number_format($property->price, thousands_separator: '') }} €
        </div>
    </div>
</div>
