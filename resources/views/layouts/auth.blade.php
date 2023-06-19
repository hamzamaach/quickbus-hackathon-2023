
<!DOCTYPE html>
<html>
<head>
    <title>@yield("title")</title>
    
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset("/bootstrap/css/bootstrap.css")}}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="{{asset("/bootstrap/js/bootstrap.js")}}"></script>
</head>
<body class="bg-info bg-opacity-10">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand ms-2" href="#">QuickBuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
       {{-- <ul class="navbar-nav ml-auto ">
            <li class="nav-item">
                <a class="nav-link" href="#">Accueil</a>
            </li>
        </ul> --}}
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

<!-- Login Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @yield("content")
        </div>
    </div>
</div>

</body>
</html>
