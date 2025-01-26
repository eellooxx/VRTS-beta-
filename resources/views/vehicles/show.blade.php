@extends('layouts.app')

@section('content')
    <div class="vehicle-details">
        <h2>Vehicle Details</h2>

        <!-- Vehicle Information -->
        <div class="vehicle-info">
            <p><strong>Brand:</strong> {{ $vehicle->brand }}</p>
            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
            <p><strong>Plate Number:</strong> {{ $vehicle->plate_number }}</p>
            <p><strong>Color:</strong> {{ $vehicle->color }}</p>
            <p><strong>Odometer:</strong> {{ number_format($vehicle->odometer) }} km</p>
            <p><strong>Description:</strong> {{ $vehicle->description }}</p>
            <p><strong>Status:</strong> <span class="status {{ strtolower($vehicle->status) }}">{{ ucfirst($vehicle->status) }}</span></p>
        </div>

        <!-- Vehicle Image -->
        @if($vehicle->image)
            <div class="vehicle-image">
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="Vehicle Image" class="img-thumbnail">
            </div>
        @endif

        <!-- Action Links -->
        <div class="actions">
            <a href="{{ route('vehicles.edit', $vehicle) }}" class="bttn btn-blue">Edit</a>
            {{-- <a href="{{ route('vehicles.index') }}" class="bttn">Back</a> --}}

            <!-- Delete Button -->
            <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="bttn btn-red" onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</button>
            </form>
        </div>
    </div>

    <style>
        .vehicle-details {
            max-width: 500px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);
            font-size: 14px;
        }

        .vehicle-info p {
            margin: 6px 0;
            font-size: 14px;
            line-height: 1.4;
        }

        .vehicle-image {
            margin-top: 10px;
            text-align: center;
        }

        .img-thumbnail {
            max-width: 250px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .actions {
            margin-top: 15px;
            display: flex;
            gap: 8px;
            justify-content: space-between;
        }

        .actions .btn {
            padding: 6px 12px;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
        }

        .delete-btn {
            background-color: #e63946;
        }

        .status {
            padding: 2px 6px;
            border-radius: 4px;
        }

        .status.available {
            background-color: #4ccd99;
            color: #fff;
        }

        .status.unavailable {
            background-color: #e63946;
            color: #fff;
        }

        @media (max-width: 600px) {
            .vehicle-details {
                padding: 10px;
                font-size: 13px;
            }

            .actions .btn {
                padding: 5px 10px;
                font-size: 12px;
            }
        }
    </style>
@endsection
