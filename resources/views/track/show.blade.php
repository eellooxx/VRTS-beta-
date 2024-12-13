@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Track Location <span id="emergency" style="display: none;color: red; font-weight: bold;">EMERGENCY!!!</span></h1>
        <div class="header-links">
            <a href="{{ route('track.index') }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>

    <div id="map"></div>
    <style>
        #map {
            height: 500px;
            width: 100%;
            margin-top: 50px;
        }
    </style>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUFkTC0pCy12a0crcsvGI2eZMLKXHHhpY"></script>
    <script>
        let map, marker;

        function initMap() {
            const philippinesBounds = {
                north: 21.120034,
                south: 4.215806,
                west: 116.928337,
                east: 126.606484,
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 12.879721, lng: 121.774017 },
                zoom: 6,
                restriction: {
                    latLngBounds: philippinesBounds,
                    strictBounds: true,
                },
                mapTypeControl: false,
                streetViewControl: false,
            });

            // Optional initial marker
            marker = new google.maps.Marker({
                position: { lat: 12.879721, lng: 121.774017 },
                map: map,
                title: "Last Location",
            });
        }

        function fetchCoordinates() {
            const rentId = "{{ $rent->id }}"; // Get the rent ID from the server
            fetch(`/track/coordinates/${rentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const coordinates = data.coordinates;
                        const emergency = data.emergency;

                        if(emergency === 1) {
                            document.getElementById("emergency").style.display = "block";
                        }
                        // Convert to the desired format [{ lat: ..., lng: ... }]
                        const formattedRouteCoordinates = coordinates.map(coord => ({
                            lat: coord.latitude,
                            lng: coord.longitude
                        }));

                        // Update marker position
                        if (marker) {
                            marker.setPosition(formattedRouteCoordinates[formattedRouteCoordinates.length - 1]);
                        } else {
                            marker = new google.maps.Marker({
                                position: latLng,
                                map: map,
                                title: "Current Location",
                            });
                        }

                        // Center and zoom the map
                        map.setCenter(formattedRouteCoordinates[formattedRouteCoordinates.length - 1]);
                        map.setZoom(15);

                        const routePolygon = new google.maps.Polyline({
                            path: formattedRouteCoordinates,
                            strokeColor: "#FF0000",
                            strokeWeight: 2,
                            map: map
                        });
                    } else {
                        const mapDiv = document.getElementById('map');
                        if (mapDiv) {
                            // Create a new message element
                            const message = document.createElement('div');
                            message.textContent = 'No Tracking Data yet';
                            message.style.textAlign = 'center'; // Optional: Center-align the message
                            message.style.fontSize = '16px'; // Optional: Adjust font size

                            // Replace the map div with the message
                            const parent = mapDiv.parentNode;
                            parent.removeChild(mapDiv);
                            parent.appendChild(message);

                            console.log('Map removed and replaced with a message.');
                        }
                        console.error(data.message);
                    }
                })
                .catch(error => console.error('Error fetching coordinates:', error));
        }

        window.onload = function () {
            initMap();
            fetchCoordinates(); // Initial fetch
            setInterval(fetchCoordinates, 60000); // Fetch every minute
        };
    </script>
@endsection