@extends('layouts.app')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container py-4">
    <!-- Navbar with Create Listing -->
    <nav class="navbar navbar-light bg-light mb-4 rounded shadow-sm px-3">
        <span class="navbar-brand mb-0 h4">Vehicle Marketplace</span>
        <a href="{{ route('vehicles.create') }}" class="btn btn-success">
            + Create Vehicle Listing
        </a>
    </nav>

    <h2 class="mb-4 text-center">Search & Hire Vehicles</h2>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('vehicles.index') }}" class="row mb-5 g-3">
        <div class="col-md-3">
            <input type="text" name="location" class="form-control" placeholder="Enter location" value="{{ request('location') }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-control">
                <option value="">-- Vehicle Type --</option>
                <option value="bus" {{ request('type') == 'bus' ? 'selected' : '' }}>Bus</option>
                <option value="omnibus" {{ request('type') == 'omnibus' ? 'selected' : '' }}>Omnibus</option>
                <option value="private" {{ request('type') == 'private' ? 'selected' : '' }}>Private Car</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="with_driver" class="form-control">
                <option value="">-- With Driver --</option>
                <option value="1" {{ request('with_driver') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ request('with_driver') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <!-- Vehicle Listings -->
    <div class="row g-4">
        @forelse ($vehicles as $vehicle)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded">
                    @php
                        $image = json_decode($vehicle->images)[0] ?? null;
                        $isUrl = $image && (Str::startsWith($image, 'http://') || Str::startsWith($image, 'https://'));
                        $imageSrc = $image ? ($isUrl ? $image : asset('storage/' . $image)) : asset('default-vehicle.jpg');
                    @endphp

                    <img src="{{ $imageSrc }}" class="card-img-top" alt="Vehicle image" style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $vehicle->title }}</h5>
                        <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-primary mt-auto w-100">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No vehicles found matching your criteria.</div>
            </div>
        @endforelse
    </div>
</div>

@endsection
