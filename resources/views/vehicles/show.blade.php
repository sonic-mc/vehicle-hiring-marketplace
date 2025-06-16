@extends('layouts.app')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            {{-- <div class="card shadow rounded"> --}}
                @php
                    $image = json_decode($vehicle->images)[0] ?? null;
                    $isUrl = $image && (Str::startsWith($image, 'http://') || Str::startsWith($image, 'https://'));
                    $imageSrc = $image ? ($isUrl ? $image : asset('storage/' . $image)) : asset('default-vehicle.jpg');
                @endphp

                <img src="{{ $imageSrc }}" class="card-img-top" alt="Vehicle Image" style="height: 300px; object-fit: cover;">

                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $vehicle->title }}</h3>

                     <!-- Inquiry Form Card -->
                        <div class="card mt-5 border-6 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Send message to publisher</h5>

                                @auth
                                    @if(session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form action="{{ route('inquiries.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                                        <div class="mb-3">
                                            <textarea name="message" class="form-control" rows="4" placeholder="Write your message here..." required></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </form>
                                @else
                                    <div class="alert alert-info mb-0">
                                        {{-- <a href="{{ route('login') }}">Login</a> to send an inquiry about this vehicle. --}}
                                    </div>
                                @endauth
                            </div>
                        </div>
                    
                    <p class="card-text"><strong>Location:</strong> {{ $vehicle->location }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ ucfirst($vehicle->type ?? 'N/A') }}</p>
                    <p class="card-text"><strong>Capacity:</strong> {{ $vehicle->capacity }} seats</p>
                    <p class="card-text"><strong>Driver Included:</strong> {{ $vehicle->with_driver ? 'Yes' : 'No' }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($vehicle->price, 2) }} / day</p>

                    <!-- Publisher Info -->
                        @if($vehicle->user)
                        <div class="card bg-light p-3 mb-4">
                            <h5>Published By</h5>
                            <div class="d-flex align-items-center">
                                {{-- Use profile image if available, else fallback to default --}}
                                <img src="{{ $vehicle->user->profile_image
                                            ? asset('storage/' . $vehicle->user->profile_image)
                                            : asset('profile.jpeg') }}"
                                    alt="Publisher Profile"
                                    class="rounded-circle me-3"
                                    style="width: 60px; height: 60px; object-fit: cover;">

                                <div>
                                    <strong>{{ $vehicle->user->name }}</strong><br>
                                    <small>Joined {{ $vehicle->user->created_at->format('F Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endif


                    <a href="{{ route('vehicles.index') }}" class="btn btn-secondary mt-3">Back to Listings</a>

                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
