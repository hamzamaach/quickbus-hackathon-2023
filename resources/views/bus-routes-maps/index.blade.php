{{--@dd($busRoute??'', $busRoutes??'', $message??'');--}}
{{--@dd($busRoute??'', $busRoutes??'', $mapData??'');--}}

    <!DOCTYPE html>
<html>

<head>
    <title>QuickBus | service</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

<body class="bg-info bg-opacity-10">
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand ms-2" href="#">QuickBuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse px-3" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Accueil</a>
            </li>
        </ul>
        @auth()
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="{{route('auth.logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Déconnexion</button>
                    </form>
                </li>
            </ul>
        @endauth

        @guest()
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class=" btn btn-success" href="{{ route('auth.login') }}">Connexion</a>
                </li>
                <li class="nav-item mx-2">
                    <a class=" btn btn-info" href="{{ route('auth.register') }}">Inscription</a>
                </li>
            </ul>
        @endguest
    </div>
</nav>

<div class="container">
    <form action="{{ route('index') }}" method="get" class="mt-4">
        <div class="input-group mb-3">
            <select name="bus_line" class="form-select">
                <option value="" hidden selected>Select Your Bus Line </option>
                @foreach($busRoutes as $busRoute)
                    <option
                        @selected($busRoute->id==request('bus_line')) value="{{$busRoute->id}}">{{$busRoute->name}}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div id="map"></div>

    <div class="py-5 border-3 border-primary">
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
        let busRoute = null;
        @if($bus_route)
            busRoute = {!! json_encode($bus_route) !!};
        @endif
        const map = new google.maps.Map(document.getElementById('map'), {
            @if($bus_route)
            center: {lng: Number(busRoute.start_longitude), lat: Number(busRoute.start_latitude)}, // Set your desired center coordinates
            @else
            center: {lat: 34.683242, lng: -1.881932}, // Set your desired center coordinates
            @endif
            zoom: 17 // Set your desired zoom level
        });
        if (busRoute) {
            const marker = new google.maps.Marker({
                map: map,
                position: {lat: Number(busRoute.start_latitude), lng: Number(busRoute.start_longitude)},
                title: busRoute.name, // Set the title for the marker if needed
            });

            const marker2 = new google.maps.Marker({
                map: map,
                position: {lat: Number(busRoute.end_latitude), lng: Number(busRoute.end_longitude)},
                title: busRoute.name, // Set the title for the marker if needed
            });

            // Create a DirectionsService instance
            const directionsService = new google.maps.DirectionsService();

            // Define the start and end coordinates
            const start = new google.maps.LatLng(Number(busRoute.start_latitude), Number(busRoute.start_longitude));
            const end = new google.maps.LatLng(Number(busRoute.end_latitude), Number(busRoute.end_longitude));
            // Create a DirectionsRequest object
            const request = {
                origin: start,
                destination: end,
                travelMode: google.maps.TravelMode.DRIVING // Use DRIVING mode for car routes
            };

            // Call the DirectionsService to get the route
            directionsService.route(request, function (result, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    // Retrieve the polyline from the result
                    const route = result.routes[0];
                    const polylinePath = route.overview_polyline;

                    // Create a Polyline object using the polyline path
                    const routePath = new google.maps.Polyline({
                        path: google.maps.geometry.encoding.decodePath(polylinePath),
                        geodesic: true,
                        strokeColor: busRoute.color, // Set the color for car route (e.g., red)
                        strokeOpacity: 1.0,
                        strokeWeight: 4, // Set the weight of the route line (e.g., thicker line)
                        map: map
                    });
                }
            });
        }
    }

</script>
</body>

</html>
