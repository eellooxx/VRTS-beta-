@extends('layouts.app')

@section('content')
<h1>Rent Management</h1>
<div class="card mb-4">
<div class="card-header">
    <i class="fas fa-table me-1"></i>
    Rents
</div>
<div class="card-body">
<table id="datatablesSimple" class="table table-striped">
    <thead>
        <tr>    
                <th>Driver</th>
                <th>Vehicle</th>
                <th>Route</th>
                <th>Status</th>
                <th>Distance Traveled</th>
                <th>Scheduled At</th>
                <th>Completed At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rents as $rent)
                <tr>
                    <td>{{ $rent->driver->firstname }} {{ $rent->driver->lastname }}</td>
                    <td>{{ $rent->vehicle->brand }} {{ $rent->vehicle->model }}</td>
                    <td>{{ $rent->route }}</td>
                    <td>{{ ucfirst($rent->status) }}</td>
                    <td>{{ $rent->distance_traveled }} KM</td>
                    <td>{{ \Carbon\Carbon::parse($rent->scheduled_at)->format('Y-m-d h:i A') }}</td>
                    <td>{{ $rent->completed_at ? \Carbon\Carbon::parse($rent->completed_at)->format('Y-m-d h:i A') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
    <a href="{{ route('rents.index') }}" class="btn">  <i class="fas fa-chevron-left"></i>Back </a>

    {{-- <a href="{{ route('rents.index') }}" class="btn">Back to Rent Management</a> --}}
@endsection
