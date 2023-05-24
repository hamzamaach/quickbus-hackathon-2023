<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public static function dashboard()
    {
        return view('bus-routes-maps.index');
    }
}
