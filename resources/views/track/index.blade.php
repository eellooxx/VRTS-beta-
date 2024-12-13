@extends('layouts.app')

@section('content')

<h1 style="font-size: 1.5em; margin: 10px 0;">Tracker</h1>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Ongoing Rents
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-striped">
            <thead>
            <tr>
                <th>Driver</th>
                <th>Vehicle</th>
                <th>Route</th>
                <th>Distance Travelled</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ongoingRents as $rent)
                <tr>
                    <td>{{ $rent->driver->firstname }} {{ $rent->driver->lastname }}</td>
                    <td>{{ $rent->vehicle->brand }} {{ $rent->vehicle->model }}</td>
                    <td>{{ $rent->route }}</td>
                    <td>{{ $rent->distance_traveled }} KM</td>
                    <td class="table-actions">
                        @if($rent->emergency == 1)
                            <span style="color: red; font-weight: bold;">EMERGENCY!!!</span>
                        @endif
                        <a href="{{ route('track.show', $rent) }}" class="bttn btn-blue">Track</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
    
    <script>
        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '9a5af1e7-7c18-4bf4-9eff-e240de9055a2',
        });

        beamsClient.start()
            .then(() => beamsClient.addDeviceInterest('emergency'))
            .then(() => { 
                console.log('Successfully registered and subscribed!'); 

                console.log('serviceWorker' in navigator);
                if ('serviceWorker' in navigator) {
                    navigator.serviceWorker.addEventListener('push', function(event) {
                        console.log('Push event received:', event);

                        // Parse the data from the push notification
                        const data = event.data ? event.data.json() : {};

                        console.log('Notification data:', data); // Log the notification data to the console

                        // Extract the title and message (if they exist) from the push payload
                        const title = data.web && data.web.notification ? data.web.notification.title : 'New Notification';
                        const message = data.web && data.web.notification ? data.web.notification.body : 'You have a new message!';
                        const icon = data.web && data.web.notification ? data.web.notification.icon : '/icon.png';
                        
                        // If there's custom data, log it
                        if (data.web && data.web.data) {
                            console.log('Custom data:', data.web.data);
                        }

                        // Show the notification if the permission is granted
                        event.waitUntil(
                            self.registration.showNotification(title, {
                                body: message,
                                icon: icon,
                                data: data.web ? data.web.data : {} // Attach any custom data to the notification
                            })
                        );
                    });
                }
            })
            .catch(console.error);

    </script>
@endsection