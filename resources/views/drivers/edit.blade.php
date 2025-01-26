<!-- Extend the main layout -->
@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Edit Driver</h1>
    <form action="{{ route('drivers.update', $driver) }}" method="POST" class="driver-form">
        @csrf
        @method('PUT')
        
        <!-- Form Fields -->
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="{{ $driver->firstname }}" required>
        
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="{{ $driver->lastname }}" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $driver->email }}" required>
        
        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" id="contact" value="{{ $driver->contact }}" required>
        
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="{{ $driver->address }}" required>
        
        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" id="birthday" value="{{ $driver->birthday }}" required>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="{{ $driver->age }}" readonly>
        
        <!-- Submit Button -->
        <button type="submit" class="bttn btn-green">Update Driver</button>
    </form>
</div>
    <style>
    /* Form Container */
    .form-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Form Styling */
    .driver-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: var(--text-color);
    }

    .driver-form input[type="text"],
    .driver-form input[type="email"],
    .driver-form input[type="number"],
    .driver-form input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        color: var(--text-color);
        box-sizing: border-box;
    }

    .driver-form input[type="text"]:focus,
    .driver-form input[type="email"]:focus,
    .driver-form input[type="number"]:focus,
    .driver-form input[type="date"]:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    /* Submit Button */
   button{
        width: 90%;
        padding: 10px;
        font-size: 16px;
    }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const birthdayInput = document.getElementById('birthday');
            const ageInput = document.getElementById('age');
    
            
            function calculateAge(birthday) {
                const birthDate = new Date(birthday);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDifference = today.getMonth() - birthDate.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }
    
            
            birthdayInput.addEventListener('input', function () {
                const birthday = birthdayInput.value;
                if (birthday) {
                    const age = calculateAge(birthday);
                    ageInput.value = age >= 18 ? age : '';
                }
            });
    
            
            ageInput.addEventListener('input', function () {
                const age = parseInt(ageInput.value, 10);
                if (!isNaN(age) && age >= 18) {
                    const today = new Date();
                    const birthYear = today.getFullYear() - age;
                    const birthDate = new Date(birthYear, today.getMonth(), today.getDate());
                    birthdayInput.value = birthDate.toISOString().split('T')[0];
                }
            });
        });
    </script>
@endsection
