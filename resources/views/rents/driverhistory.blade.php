@extends('layouts.app')

@section('content')

<h1 style="font-size: 1.5em; margin: 10px 0;">{{ $driver->firstname }} {{ $driver->lastname }} - Driver History</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        History
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
        <thead>
            <tr>
                <th>Vehicle</th>
                <th>Route</th>
                <th>Status</th>
                <th>Scheduled At</th>
                <th>Completed At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rents as $rent)
                <tr>
                    <td>{{ $rent->vehicle->brand }} {{ $rent->vehicle->model }}</td>
                    <td>{{ $rent->route }}</td>
                    <td>{{ ucfirst($rent->status) }}</td>
                    <td>{{ $rent->scheduled_at }}</td>
                    <td>{{ $rent->completed_at ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No rental history available for this driver.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>

    <a href="{{ route('rents.index') }}">Back</a>
@endsection