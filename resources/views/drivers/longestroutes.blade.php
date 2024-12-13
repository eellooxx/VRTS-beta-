@extends('layouts.app')

@section('content')
    <h1 style="font-size: 1.5em; margin: 10px 0;">Driver Report</h1>
    <div class="card mb-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Driver Name</th>
                <th>Email</th>
                <th>Longest Route</th>
                <th>Distance Traveled (KM)</th>
                <th>Scheduled At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                @if($driver->rents->isNotEmpty())
                    <tr>
                        <td>{{ $driver->firstname }} {{ $driver->lastname }}</td>
                        <td>{{ $driver->email }}</td>
                        <td>{{ $driver->rents->first()->route }}</td>
                        <td>{{ $driver->rents->first()->distance_traveled }} KM</td>
                        <td>{{ $driver->rents->first()->scheduled_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $driver->firstname }} {{ $driver->lastname }}</td>
                        <td>{{ $driver->email }}</td>
                        <td colspan="3">No routes found</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    </div>
@endsection