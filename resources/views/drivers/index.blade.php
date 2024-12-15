@extends('layouts.app')

@section('content')

    <h1 style="font-size: 1.5em; margin: 10px 0;">Driver Management</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user"></i>
            Driver
        </div>
        <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->firstname }} {{ $driver->lastname }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>{{ $driver->contact }}</td>
                    <td>{{ $driver->address }}</td>
                    <td>
                        <span class="status {{ $driver->is_active ? 'active' : 'inactive' }}">
                            {{ $driver->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="table-actions">
                        <a href="{{ route('drivers.edit', $driver) }}" class="bttn btn-blue">Edit</a>
                        <form action="{{ route('drivers.toggleStatus', $driver) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bttn btn-red {{ $driver->is_active ? 'btn-inactive' : 'btn-active' }}">
                                {{ $driver->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
    <a href="{{ route('home') }}" class="btn btn-back">Home</a>
@endsection
