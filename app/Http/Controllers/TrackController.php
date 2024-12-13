<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        // $ongoingRents = Rent::where('status', 'ongoing')->get();// Show all
        $ongoingRents = Rent::where('status', 'ongoing')->where('emergency', 0)->get(); // Show all non-emergency tracking
        return view('track.index', compact('ongoingRents'));
    }

    /**
     * Display the location of specified rent.
     */
    public function show(Rent $rent)
    {
        $coordinates = $rent->coordinates;
        return view('track.show', compact('rent', 'coordinates'));
    }

    public function fetchCoordinates(Rent $rent)
    {
        $coordinates = $rent->coordinates;
        $emergency = $rent->emergency;

        if ($coordinates) {
            return response()->json(['success' => true, 'coordinates' =>  $decodedCoordinates = json_decode($coordinates, true), 'emergency' => $emergency]);
        }

        return response()->json(['success' => false, 'message' => 'Coordinates not found.']);
    }
}
