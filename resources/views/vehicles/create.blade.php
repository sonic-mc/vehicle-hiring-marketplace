@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Vehicle Listing</h2>
    <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
        <textarea name="description" placeholder="Description" class="form-control mb-2" required></textarea>
        <input type="text" name="location" placeholder="Location" class="form-control mb-2" required>
        <input type="number" name="price" placeholder="Price (USD)" class="form-control mb-2" required>
        <input type="number" name="capacity" placeholder="Capacity (seats)" class="form-control mb-2" required>

        <select name="purpose" class="form-control mb-2">
            <option value="wedding">Wedding</option>
            <option value="funeral">Funeral</option>
            <option value="church">Church</option>
            <option value="tour">Tour</option>
            <option value="trip">Trip</option>
            <option value="other">Other</option>
        </select>

        <label>Images</label>
        <input type="file" name="images[]" class="form-control mb-2" multiple>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>
@endsection
