@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $vehicle->title }}</h2>

    <p><strong>Location:</strong> {{ $vehicle->location }}</p>
    <p><strong>Price:</strong> ${{ $vehicle->price }}</p>
    <p><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
    <p><strong>Purpose:</strong> {{ ucfirst($vehicle->purpose) }}</p>
    <p><strong>Description:</strong> {{ $vehicle->description }}</p>

    @if($vehicle->images)
        <div class="row mt-3">
            @foreach (json_decode($vehicle->images) as $image)
                <div class="col-md-3">
                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded">
                </div>
            @endforeach
        </div>
    @endif

    <hr>
    <a href="{{ route('inquiries.create', $vehicle->id) }}" class="btn btn-success">Send Inquiry</a>
</div>
@endsection
