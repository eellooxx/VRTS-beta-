<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Home</div>
            <a class="nav-link" href="{{ route('home') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            {{-- Track --}}
            <a class="nav-link" href="{{ route('track.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                Track
            </a>
            {{-- Rents --}}
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRents" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                Rents
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseRents" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('rents.create') }}">Create Rent</a>
                    <a class="nav-link" href="{{ route('rents.index') }}">Rent Management</a>
                    <a class="nav-link" href="{{ route('rents.history') }}">History</a>
                    <a class="nav-link" href="{{ route('rents.driverport') }}">Driver Report</a>
                </nav>
            </div>
            {{-- Drivers --}}
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDrivers" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Drivers
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseDrivers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('drivers.create') }}" >Add Driver</a>
                    <a class="nav-link" href="{{ route('drivers.longestroutes') }}">Driver Routes</a>
                    <a class="nav-link" href="{{ route('drivers.index') }}">Driver Management</a>
                </nav>
            </div>
            {{-- Vehicles --}}
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVehicles" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fa fa-car"></i></div>
                Vehicles
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseVehicles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('vehicles.create') }}">Add Vehicle</a>
                    <a class="nav-link" href="{{ route('vehicles.index') }}">Vehicle Management</a>
                </nav>
            </div>
            {{-- Emergency --}}
            <a class="nav-link" href="{{ route('rents.emergency') }}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                Emergency
            </a>
            <a style="float:left;text-decoration: none;" class="nav-link" href="javascript:history.back()">
               <div class="sb-nav-link-icon"><i class="fa fa-angle-left"></i></div>
               
               &nbsp;{{ __('Back ') }}
              </a>
        </div>
    </div>
    {{-- <div class="sb-sidenav-footer">
        <div class="small">Logged in as: {{ Auth::user()->name }}</div>
    </div> --}}
</nav>
