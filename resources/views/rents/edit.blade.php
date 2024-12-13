@extends('layouts.app')

@section('content')
<div class="rents-edit-container">
    <h1>Edit Rent</h1>

    <form action="{{ route('rents.update', $rent) }}"   method="POST">
        @csrf
        @method('PUT')

        <label for="driver">Driver:</label>
        <select name="driver_id" id="driver">
            @foreach($drivers as $driver)
            <option value="{{ $driver->id }}" 
                {{ $rent->driver_id == $driver->id ? 'selected' : '' }}>
                {{ $driver->firstname }} {{ $driver->lastname }}
            </option>
            @endforeach
        </select>

        <br><br>

        <label for="vehicle">Vehicle:</label>
        <select name="vehicle_id" id="vehicle">
            @foreach($vehicles as $vehicle)
            <option value="{{ $vehicle->id }}" 
                {{ $rent->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                {{ $vehicle->brand }} {{ $vehicle->model }}
            </option>
            @endforeach
        </select>

        <br><br>

        <label for="route">Route:</label>
        <input type="text" name="route" id="route" value="{{ $rent->route }}">

        <br><br>

        <label for="scheduled_at">Scheduled At:</label>
        <input type="datetime-local" name="scheduled_at" id="scheduled_at" 
               value="{{ date('Y-m-d\TH:i', strtotime($rent->scheduled_at)) }}">

        <br><br>

        <button type="submit" class="bttn btn-green">Update Rent</button>
    </form>
</div>
    <a href="{{ route('rents.index') }}">Back to Rent List</a>
    @if ($errors->any())
        <script>
            alert("{{ implode('\n', $errors->all()) }}");
        </script>
    @endif

    <style>
    .rents-edit-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        color: var(--text-color);
        font-family: Arial, sans-serif;
    }
    
    /* Form label styling */
    .rents-edit-container label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: var(--text-color);
    }
    
    /* Input and select field styling */
    .rents-edit-container input[type="text"],
    .rents-edit-container input[type="number"],
    .rents-edit-container input[type="file"],
    .rents-edit-container select,
    .rents-edit-container textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        color: var(--text-color);
    }
    
    /* Textarea specific styling */
    .rents-edit-container textarea {
        resize: vertical;
    }
    
    /* Submit button styling */
    .rents-edit-container .btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
        font-size: 15px;
    }
    
    .rents-edit-container .btn:hover {
        background-color: var(--secondary-color);
    }
    
    /* Responsive Design for Smaller Screens */
    @media (max-width: 600px) {
        .rents-edit-container {
            padding: 15px;
            font-size: 13px;
        }
    
        .rents-edit-container label,
        .rents-edit-container input,
        .rents-edit-container select,
        .rents-edit-container textarea,
        .rents-edit-container .btn {
            font-size: 13px;
        }
    
        .rents-edit-container .btn {
            padding: 8px;
        }
    }
    </style>
    @endsection