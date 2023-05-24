
<!DOCTYPE html>
<html>
<head>
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{asset("/bootstrap/css/bootstrap.css")}}">
    <script src="{{asset("/bootstrap/js/bootstrap.js")}}"></script>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#">QuickBuss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
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
