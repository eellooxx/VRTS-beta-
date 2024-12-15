<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $totalRents = Rent::count();
        $totalDrivers = Driver::count();
        $totalVehicles = Vehicle::count();

        return view('home', compact('totalRents', 'totalDrivers', 'totalVehicles'));
    }
}
