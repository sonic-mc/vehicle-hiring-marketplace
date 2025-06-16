@extends('layouts.app')

@section('content')
<div class="container py-10">
    <div class="vehicle-card">
        <h2 class="card-title">Create Vehicle Listing</h2>

        <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="title" placeholder="Title" class="form-control" required>
            </div>

            <div class="form-group">
                <textarea name="description" placeholder="Description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <input type="text" name="location" placeholder="Location" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="number" name="price" placeholder="Price (USD)" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="number" name="capacity" placeholder="Capacity (seats)" class="form-control" required>
            </div>

            <div class="form-group">
                <select name="purpose" class="form-control">
                    <option value="wedding">Wedding</option>
                    <option value="funeral">Funeral</option>
                    <option value="church">Church</option>
                    <option value="tour">Tour</option>
                    <option value="trip">Trip</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Images</label>
                <input type="file" name="images[]" class="form-control" multiple>
            </div>

            <div class="submit-btn">
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

<style>
    .vehicle-card {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007BFF;
        outline: none;
    }

    .submit-btn {
        text-align: center;
    }

    .btn {
        padding: 12px 30px;
        background-color: #007BFF;
        color: #fff;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>
