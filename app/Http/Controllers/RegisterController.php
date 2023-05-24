<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }
    public function doRegister(CreateUserRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect(route("auth.login"));
    }
}
