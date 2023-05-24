{{--@dd($busRoute??'', $busRoutes??'', $message??'');--}}
    <!DOCTYPE html>
<html>

<head>
    <title>QuickBus</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        /* Set the height of the map container */
        #map {
            height: 500px;
        }
    </style>

</head>

<body>
<div class="container">
    <h1 class="mt-5">Welcome To QuickBus</h1>
    <form action="{{ route('dashboard') }}" method="GET" class="mt-4">
        <div class="input-group mb-3">
            <select name="bus_line" class="form-select">
                @foreach($busRoutes as $busRoute)
                    <option value="{{$busRoute->id}}">{{$busRoute->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div id="map"></div>

    <div id="ad-div p-5 border-3 border-primary">
        {{--        {!! $adCode !!} --}}
        <h4>This section is reserved for the ads</h4>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=initMap" async
        defer></script>

<script>
    // Initialize and display the map
    function initMap() {
        // Create a map instance
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 40.7128, lng: -74.0060}, // Set your desired center coordinates
            zoom: 12 // Set your desired zoom level
        });

        // Retrieve and display the bus routes on the map
        var busRoutes = {!! json_encode($busRoutes) !!}; // Pass the bus routes data from your backend
        console.log(busRoutes)
        for (var i = 0; i < busRoutes.length; i++) {
            var busRoute = busRoutes[i];
            var busRouteCoordinates = [
                { lng: busRoute.start_longitude, lat: busRoute.start_latitude}, // Set the origin coordinates
                {lng: busRoute.end_longitude, lat: busRoute.end_latitude} // Set the destination coordinates
            ];
            console.log(busRouteCoordinates)

            var routePath = new google.maps.Polyline({
                path: busRouteCoordinates,
                geodesic: true,
                strokeColor: busRoute.color, // Set the color for each bus route
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            routePath.setMap(map);
        }
    }
</script>
</body>

</html>
