@extends('layouts.app')

@section('content')
<h1 style="font-size: 1.5em; margin: 10px 0;">Rent Management</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-check"></i>
        Rent 
    </div>
    <div class="card-body">
    <table id="datatablesSimple" class="table table-striped">
        <thead>
            <tr>
                <th>Driver</th>
                <th>Vehicle</th>
                <th>Route</th>
                <th>Scheduled At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ongoingRents as $rent)
                <tr>
                    <td>{{ $rent->driver->firstname }} {{ $rent->driver->lastname }}</td>
                    <td>{{ $rent->vehicle->brand }} {{ $rent->vehicle->model }}</td>
                    <td>{{ $rent->route }}</td>
                    <td>{{ \Carbon\Carbon::parse($rent->scheduled_at)->format('Y-m-d h:i A') }}</td>
                    <td class="table-actions">
                        <form action="{{ route('rents.complete', $rent) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bttn btn-green">Mark as Completed</button>
                        </form>
                        <a href="{{ route('rents.edit', $rent) }}" class="bttn btn-blue">Edit</a>
                        <form action="{{ route('rents.cancel', $rent) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class=" bttn btn-red">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

    {{-- <a href="{{ route('home') }}" class="btn btn-back">Home</a> --}}
@endsection
