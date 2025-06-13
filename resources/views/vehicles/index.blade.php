@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Vehicles</h2>
    <div class="row">
        @foreach ($vehicles as $vehicle)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($vehicle->images && count(json_decode($vehicle->images)) > 0)
                        <img src="{{ asset('storage/' . json_decode($vehicle->images)[0]) }}" class="card-img-top" alt="Vehicle image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->title }}</h5>
                        <p class="card-text">{{ $vehicle->location }}</p>
                        <p>${{ $vehicle->price }} | Seats: {{ $vehicle->capacity }}</p>
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
