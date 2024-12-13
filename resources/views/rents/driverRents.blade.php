@extends('layouts.app')

@section('content')
    <h1>Driver Rents</h1>
    <table>
        <thead>
            <tr>
                <th>Driver Name</th>
                <th>Email</th>
                <th>Rents</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->firstname }} {{ $driver->lastname }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>
                        <a href="#" class="view-rents" data-driver-id="{{ $driver->id }}">View Rents</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="rents-modal" style="display:none;">
        <h2>Rents for <span id="driver-name"></span></h2>
        <table id="rents-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vehicle</th>
                    <th>Route</th>
                    <th>Scheduled At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="rents-body">
                <!-- Rents will be populated here via JavaScript -->
            </tbody>
        </table>
        <button id="close-modal">Close</button>
    </div>

    <script>
        document.querySelectorAll('.view-rents').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const driverId = this.getAttribute('data-driver-id');
                const driverName = this.closest('tr').children[0].innerText;

                // Fetch rents for the selected driver
                fetch(`/drivers/${driverId}/rents`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('driver-name').innerText = driverName;
                        const rentsBody = document.getElementById('rents-body');
                        rentsBody.innerHTML = ''; // Clear previous rents

                        data.rents.forEach(rent => {
                            const row = `<tr>
                                <td>${rent.id}</td>
                                <td>${rent.vehicle.brand} ${rent.vehicle.model}</td>
                                <td>${rent.route}</td>
                                <td>${rent.scheduled_at}</td>
                                <td>${rent.status}</td>
                            </tr>`;
                            rentsBody.innerHTML += row;
                        });

                        document.getElementById('rents-modal').style.display = 'block';
                    });
            });
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('rents-modal').style.display = 'none';
        });
    </script>
@endsection