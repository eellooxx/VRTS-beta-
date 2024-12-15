@extends('layouts.app')

@section('content')
  
                
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row" style="margin-top: 3%;">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Drivers</h5>
                    <p class="card-text">{{ $totalDrivers }}</p>
                    <a href="{{ route('drivers.index') }}" class="btn btn-light">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Rents</h5>
                    <p class="card-text">{{ $totalRents }}</p>
                    <a href="{{ route('rents.index') }}" class="btn btn-light">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Vehicles</h5>    
                    <p class="card-text">{{ $totalVehicles }}</p>
                    <a href="{{ route('vehicles.index') }}" class="btn btn-light">View All <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
