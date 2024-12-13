@extends('layouts.app')

@section('content')
<h1 style="font-size: 1.5em; margin: 10px 0;">Driver Report</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Drivers
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Total Booking</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rents as $driverRents)
                @php
                    // Get the first rent from the grouped rents
                    $firstRent = $driverRents->first();
                @endphp
                <tr>
                    <!-- Display driver name once for each group -->
                    <td><a href="{{ route('rents.driverhistory', $firstRent->driver->id) }}">{{ $firstRent->driver->firstname }} {{ $firstRent->driver->lastname }}</a></td>
                   <td> {{ $driverRents->count() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="1">No history logs available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>

    <a href="{{ route('rents.index') }}">Back to Rent Management</a>
@endsection