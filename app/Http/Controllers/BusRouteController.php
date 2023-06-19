<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Http\Requests\StoreBusRouteRequest;
use App\Http\Requests\UpdateBusRouteRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BusRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BusRoute::query();
        $bus_route = null;
        if ($request->bus_line) {
            $bus_route = $query->whereId((int)$request->bus_line)->first();
        }
        $busRoutes = BusRoute::all();
        return view('bus-routes-maps.index', compact('busRoutes', 'bus_route'));
    }

}
