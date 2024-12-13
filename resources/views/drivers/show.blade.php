<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Details</title>
    <style>
        body {
    width: 100%;
    height: 100vh;
    margin: 0 auto;
    font-family: Tahoma;
    font-size: 16px;
        }
</style>
</head>
<body>
    <h1>Driver Details</h1>

    <p><strong>First Name:</strong> {{ $driver->firstname }}</p>
    <p><strong>Last Name:</strong> {{ $driver->lastname }}</p>
    <p><strong>Email:</strong> {{ $driver->email }}</p>
    <p><strong>Contact:</strong> {{ $driver->contact }}</p>
    <p><strong>Address:</strong> {{ $driver->address }}</p>
    <p><strong>Age:</strong> {{ $driver->age }}</p>
    <p><strong>Birthday:</strong> {{ $driver->birthday->format('F d, Y') }}</p>
    <p><strong>Status:</strong> {{ $driver->is_active ? 'Active' : 'Inactive' }}</p>

    <a href="{{ route('drivers.edit', $driver) }}">Edit Driver</a> |
    <a href="{{ route('drivers.index') }}">Back to Driver List</a>

    <form action="{{ route('drivers.toggleStatus', $driver) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <button type="submit">
            {{ $driver->is_active ? 'Deactivate' : 'Activate' }}
        </button>
    </form>
</body>
</html>