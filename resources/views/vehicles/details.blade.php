@extends('layouts.app')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow rounded">
                @php
                    $image = json_decode($vehicle->images)[0] ?? null;
                    $isUrl = $image && (Str::startsWith($image, 'http://') || Str::startsWith($image, 'https://'));
                    $imageSrc = $image ? ($isUrl ? $image : asset('storage/' . $image)) : asset('default-vehicle.jpg');
                @endphp

                <img src="{{ $imageSrc }}" class="card-img-top" alt="Vehicle Image" style="height: 300px; object-fit: cover;">

                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $vehicle->title }}</h3>
                    <p class="card-text"><strong>Location:</strong> {{ $vehicle->location }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ ucfirst($vehicle->type ?? 'N/A') }}</p>
                    <p class="card-text"><strong>Capacity:</strong> {{ $vehicle->capacity }} seats</p>
                    <p class="card-text"><strong>Driver Included:</strong> {{ $vehicle->with_driver ? 'Yes' : 'No' }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($vehicle->price, 2) }} / day</p>
                    
                    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-3">Back to Listings</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
