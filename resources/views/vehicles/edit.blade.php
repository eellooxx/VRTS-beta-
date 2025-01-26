@extends('layouts.app')

@section('content')
    <div class="vehicle-edit-container">
        <h2>Edit Vehicle</h2>
        
        <form action="{{ route('vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Brand Field -->
            <label for="brand">Brand</label>
            <input type="text" id="brand" name="brand" value="{{ $vehicle->brand }}" required>

            <!-- Model Field -->
            <label for="model">Model</label>
            <input type="text" id="model" name="model" value="{{ $vehicle->model }}" required>

            <!-- Plate Number Field -->
            <label for="plate_number">Plate Number</label>
            <input type="text" id="plate_number" name="plate_number" value="{{ $vehicle->plate_number }}" required>

            <!-- Color Field -->
            <label for="color">Color</label>
            <input type="text" id="color" name="color" value="{{ $vehicle->color }}">

            <!-- Odometer Field -->
            <label for="odometer">Odometer (km)</label>
            <input type="number" id="odometer" name="odometer" value="{{ $vehicle->odometer }}" min="0">

            <!-- Description Field -->
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3">{{ $vehicle->description }}</textarea>

            <!-- Status Dropdown -->
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="in-use" {{ $vehicle->status == 'in-use' ? 'selected' : '' }}>In-Use</option>
                <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>

            <!-- Image Upload Field -->
            <label for="image">Upload Image</label>
            <input type="file" id="image" name="image">

            <!-- Submit Button -->
            <button type="submit" class="bttn btn-green">Update Vehicle</button>
        </form>
    </div>

    <style>
        /* Container styling */
        .vehicle-edit-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form label styling */
        .vehicle-edit-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        /* Input and select field styling */
        .vehicle-edit-container input[type="text"],
        .vehicle-edit-container input[type="number"],
        .vehicle-edit-container input[type="file"],
        .vehicle-edit-container select,
        .vehicle-edit-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Textarea specific styling */
        .vehicle-edit-container textarea {
            resize: vertical;
        }

        /* Submit button styling */
        .vehicle-edit-container .btn {
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

        .vehicle-edit-container .btn:hover {
            background-color: var(--secondary-color);
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 600px) {
            .vehicle-edit-container {
                padding: 15px;
                font-size: 13px;
            }

            .vehicle-edit-container label,
            .vehicle-edit-container input,
            .vehicle-edit-container select,
            .vehicle-edit-container textarea,
            .vehicle-edit-container .btn {
                font-size: 13px;
            }

            button {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            }
        }
    </style>
    <script>
        const plateNumberInput = document.getElementById('plate_number');
    
        plateNumberInput.addEventListener('input', function() {
            const plateNumber = this.value.toUpperCase();
            const regex = /^[A-Z]{3}[0-9]{4}$/;
    
            if (!regex.test(plateNumber)) {
                this.setCustomValidity('Invalid license plate format. Please enter 3 letters followed by 4 numbers.');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
@endsection
