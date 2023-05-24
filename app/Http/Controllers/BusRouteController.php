<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Http\Requests\StoreBusRouteRequest;
use App\Http\Requests\UpdateBusRouteRequest;
use Illuminate\Http\Request;

class BusRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busRoutes=BusRoute::all();
        return view('bus-routes-maps.index', compact('busRoutes'));

    }

}
