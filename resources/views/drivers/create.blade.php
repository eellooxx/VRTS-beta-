<!-- Extend the main layout -->
@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1>Add Driver</h1>
    <form action="{{ route('drivers.store') }}" method="POST" class="driver-form">
        @csrf

        <!-- Input Fields -->
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" placeholder="First Name" required>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <label for="contact">Contact Number:</label>
        <input type="text" name="contact" id="contact" placeholder="Contact" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" placeholder="Address" required>

        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" id="birthday" required>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" placeholder="Age" readonly>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>

        <!-- Submit Button -->
        <button type="submit" style="display:block; margin: 0 auto;" class="bttn btn-green">Add Driver</button>
    </form>
</div>
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
    .driver-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: var(--text-color);
    }

    .driver-form input[type="text"],
    .driver-form input[type="email"],
    .driver-form input[type="number"],
    .driver-form input[type="date"],
    .driver-form input[type="password"] {
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
    .driver-form input[type="date"]:focus,
    .driver-form input[type="password"]:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    /* Submit Button */
    .driver-form .btn {
        width: 100%;
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
