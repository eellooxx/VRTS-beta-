<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Details</title>
</head>
<body>
    <h1>Rent Details</h1>

    <p><strong>Driver:</strong> {{ $rent->driver->firstname }} {{ $rent->driver->lastname }}</p>
    <p><strong>Vehicle:</strong> {{ $rent->vehicle->brand }} {{ $rent->vehicle->model }}</p>
    <p><strong>Route:</strong> {{ $rent->route }}</p>
    <p><strong>Scheduled At:</strong> {{ $rent->scheduled_at->format('F d, Y h:i A') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($rent->status) }}</p>

    @if($rent->completed_at)
        <p><strong>Completed At:</strong> {{ $rent->completed_at->format('F d, Y h:i A') }}</p>
    @endif

    <a href="{{ route('rents.edit', $rent) }}">Edit Rent</a> |
    <a href="{{ route('rents.index') }}">Back to Rent List</a>

    @if($rent->status === 'ongoing')
        <form action="{{ route('rents.cancel', $rent) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" onclick="return confirm('Are you sure you want to cancel this rent?');">
                Cancel Rent
            </button>
        </form>
    @endif
</body>
</html>