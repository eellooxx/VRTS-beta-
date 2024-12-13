@extends('layouts.app')

@section('content')

<h1 style="font-size: 1.5em; margin: 10px 0;">Vehicle Management</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Vehicle
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vehicles as $vehicle)
                <tr>
            <td>{{ $vehicle->brand }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ ucfirst($vehicle->status) }}</td>
            <td>
                <a href="{{ route('vehicles.show', $vehicle) }}" class="bttn btn-green">View</a> |
                <a href="{{ route('vehicles.edit', $vehicle) }}" class="bttn btn-blue">Edit</a> |
                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="bttn btn-red" type="submit">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
    <a href="{{ route('home') }}" class="btn btn-back">Home</a>
@endsection