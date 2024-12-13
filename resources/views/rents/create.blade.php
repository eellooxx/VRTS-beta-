<!-- Extend the main layout -->
@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Create Rent</h1>
    <form action="{{ route('rents.store') }}" method="POST" class="rent-form">
        @csrf

        <!-- Driver Selection -->
        <label for="driver_id">Select Driver:</label>
        <select name="driver_id" id="driver_id" required>
            @foreach($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->firstname }} {{ $driver->lastname }}</option>
            @endforeach
        </select>

        <!-- Vehicle Selection -->
        <label for="vehicle_id">Select Vehicle:</label>
        <select name="vehicle_id" id="vehicle_id" required>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->id }}">{{ $vehicle->brand }} {{ $vehicle->model }}</option>
            @endforeach
        </select>

        <!-- Route Input -->
        <label for="route">Route:</label>
        <input type="text" name="route" id="route" placeholder="Route" required>

        <!-- Schedule Date and Time -->
        <label for="scheduled_at">Scheduled At:</label>
        <input type="datetime-local" name="scheduled_at" id="scheduled_at" required>

        <!-- Submit Button -->
        <button type="submit" style="display:block; margin: 0 auto;" class="bttn btn-green">Create Rent</button>
    </form>
</div>
@if ($errors->any())
    <script>
        alert("{{ implode('\n', $errors->all()) }}");
    </script>
@endif
    <style>
        /* Form Container */
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
    .rent-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: var(--text-color);
    }

    .rent-form input[type="text"],
    .rent-form input[type="datetime-local"],
    .rent-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        color: var(--text-color);
        box-sizing: border-box;
    }

    .rent-form input[type="text"]:focus,
    .rent-form input[type="datetime-local"]:focus,
    .rent-form select:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    /* Submit Button */
    .rent-form .btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
    </style>
@endsection
