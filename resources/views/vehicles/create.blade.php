@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1 class="card-header">Add Vehicle</h1>
    <form action="{{ route('vehicles.store') }}" method="POST"class="vehicle-form" enctype="multipart/form-data">
        @csrf
        <label for="brand" class="col-md-4 col-form-label text-md-right">Brand:</label>                        
        <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus>
            @error('brand')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <label for="model" class="col-md-4 col-form-label text-md-right">Model:</label>

            <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" required autocomplete="model">
            @error('model')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="plate_number" class="col-md-4 col-form-label text-md-right">Plate Number:</label>

            <input id="plate_number" type="text" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" value="{{ old('plate_number') }}" required autocomplete="plate_number">
            @error('plate_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="color" class="col-md-4 col-form-label text-md-right">Color:</label>

            <input id="color" type="text" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ old('color') }}" required autocomplete="color">
            @error('color')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="odometer" class="col-md-4 col-form-label text-md-right">Odometer:</label>

            <input id="odometer" type="number" class="form-control @error('odometer') is-invalid @enderror" name="odometer" value="{{ old('odometer') }}" required autocomplete="odometer">
            @error('odometer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="status" class="col-md-4 col-form-label text-md-right">Status:</label>

            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                <option value="available">Available</option>
                <option value="in-use">In-Use</option>
                <option value="maintenance">Maintenance</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <label for="image" class="col-md-4 col-form-label text-md-right">Image:</label>

            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" required>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" style="display:block; margin: 0 auto;" class="bttn btn-green">
                Save
            </button>
    </form>
</div>
<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Form Styling */
    .vehicle-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: var(--text-color);
    }

    .vehicle-form input[type="text"],
    .vehicle-form input[type="email"],
    .vehicle-form input[type="number"],
    .vehicle-form input[type="date"],
    .vehicle-form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        color: var(--text-color);
        box-sizing: border-box;
    }

    .vehicle-form input[type="text"]:focus,
    .vehicle-form input[type="email"]:focus,
    .vehicle-form input[type="number"]:focus,
    .vehicle-form input[type="date"]:focus,
    .vehicle-form input[type="file"]:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    /* Submit Button */
    .vehicle-form .btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
</style>
@endsection
