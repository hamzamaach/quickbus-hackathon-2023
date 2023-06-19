@extends("layouts.auth")
@section("title" , "register")

@section("content")
    <h2 class="text-uppercase">Inscrivez-vous</h2>
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('auth.doRegister')}}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="nom">Nom :</label>
                    <input class="form-control" value="{{old("nom")}}" name="nom" id="nom" placeholder="nom"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="prenom">Prenom :</label>
                    <input class="form-control" value="{{old("prenom")}}" name="prenom" id="prenom" placeholder="prenom"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="ville">ville</label>
                    <input class="form-control" value="{{old("ville")}}" name="ville" id="ville" placeholder="ville"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="tele">Tele :</label>
                    <input class="form-control" value="{{old("tele")}}" name="tele" id="tele" placeholder="tele"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-control" value="{{old("email")}}" name="email" id="email" placeholder="email@email.com"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">mot de pass</label>
                    <input class="form-control" placeholder="mot de pass"  type="password" name="password" id="password"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">confirmer mot de pass</label>
                    <input class="form-control" placeholder="mot de pass"  name="password_confirmation" type="password" id="password_confirmation"/>
                </div>
                <div class="form-check my-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                    <label class="form-check-label" for="flexCheckChecked">
                        J'accepte les termes et les policies d'application.
                    </label>
                </div>
                <button type="submit" class="btn btn-primary mt-4 w-100">Register</button>
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
