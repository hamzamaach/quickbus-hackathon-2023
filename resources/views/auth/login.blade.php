@extends("layouts.auth")
@section("title" , "login")

@section("content")
    <h2 class="text-uppercase">se connecter</h2>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('auth.doLogin')}}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-control" name="email" id="email" placeholder="email@email.com"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">mot de pass</label>
                    <input class="form-control" placeholder="mot de pass" name="password" id="password"/>
                </div>
                <button type="submit" class="btn btn-primary mt-4 w-100">se connecter</button>
            </form>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
