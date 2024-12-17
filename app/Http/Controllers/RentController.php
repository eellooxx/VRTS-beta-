<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ongoingRents = Rent::where('status', 'ongoing')->get();
        $completedRents = Rent::where('status', 'completed')->get();
        return view('rents.index', compact('ongoingRents', 'completedRents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drivers = Driver::where('is_active', true)->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('rents.create', compact('drivers', 'vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'driver_id' => [
                'required',
                'exists:drivers,id',
                function ($attribute, $value, $fail) use ($request) {
                    $this->validateDriverDailyAvailability($value, $request->scheduled_at, $fail);
                },
            ],
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
                function ($attribute, $value, $fail) use ($request) {
                    $this->validateVehicleDailyAvailability($value, $request->scheduled_at, $fail);
                },
            ],
            'route' => 'required|string|max:255',
            'scheduled_at' => [
                'required',
                'date',
                'after_or_equal:now', // Prevent scheduling in the past
            ],
        ]);

        $data['distance_traveled'] = 0;
        $data['emergency'] = 0;
        $data['coordinates'] = "";
        
        $data['user_id'] = auth()->id();

        Rent::create($data);
    
        return redirect()->route('rents.index')->with('success', 'Rent scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent $rent)
    {
        return view('rents.show', compact('rent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rent $rent)
    {
        $drivers = Driver::where('is_active', true)->get();
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('rents.edit', compact('rent', 'drivers', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rent $rent)
    {
        $data = $request->validate([
            'driver_id' => [
                'required',
                'exists:drivers,id',
                function ($attribute, $value, $fail) use ($request, $rent) {
                    $this->validateDriverDailyAvailability($value, $request->scheduled_at, $fail, $rent->id);
                },
            ],
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
                function ($attribute, $value, $fail) use ($request, $rent) {
                    $this->validateVehicleDailyAvailability($value, $request->scheduled_at, $fail, $rent->id);
                },
            ],
            'route' => 'required|string|max:255',
            'scheduled_at' => [
                'required',
                'date',
                'after_or_equal:now', // Prevent scheduling in the past
            ],
        ]);
    
        $rent->update($data);
    
        return redirect()->route('rents.index')->with('success', 'Rent updated successfully.');
    }

    public function cancel(Rent $rent)
    {
        $rent->update(['status' => 'cancelled']);

        return redirect()->route('rents.index')->with('success', 'Rent cancelled.');
    }

    public function history(Rent $rent)
    {
        $rents = Rent::whereIn('status', ['completed', 'cancelled'])->get();
        return view('rents.history', compact('rents'));
    }

    public function complete(Rent $rent)
    {
        // Update rent status and set the completion timestamp
        $rent->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    
        // update the vehicle status to "available"
        $rent->vehicle->update(['status' => 'available']);
    
        return redirect()->route('rents.index')->with('success', 'Rent marked as completed.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent $rent)
    {
        //
    }

    protected function validateDriverDailyAvailability($driverId, $scheduledAt, $fail, $excludeRentId = null)
    {
        $date = date('Y-m-d', strtotime($scheduledAt));
    
        $conflict = Rent::where('driver_id', $driverId)
                        ->whereDate('scheduled_at', $date)
                        ->where('status', 'ongoing')
                        ->when($excludeRentId, function ($query) use ($excludeRentId) {
                            $query->where('id', '!=', $excludeRentId);
                        })
                        ->exists();
    
        if ($conflict) {
            $fail('The selected driver is already assigned to another rent on this date.');
        }
    }
    
    protected function validateVehicleDailyAvailability($vehicleId, $scheduledAt, $fail, $excludeRentId = null)
    {
        $date = date('Y-m-d', strtotime($scheduledAt));
    
        $conflict = Rent::where('vehicle_id', $vehicleId)
                        ->whereDate('scheduled_at', $date)
                        ->where('status', 'ongoing')
                        ->when($excludeRentId, function ($query) use ($excludeRentId) {
                            $query->where('id', '!=', $excludeRentId);
                        })
                        ->exists();
    
        if ($conflict) {
            $fail('The selected vehicle is already assigned to another rent on this date.');
        }
    }

    public function updateLocation(Request $request, $id)
    {

        $request->validate([
            'totalKilometers' => 'required|numeric',
            'coordinates' => 'required|string'
        ]);

        $rent = Rent::findOrFail($id);
        $rent->distance_traveled = $request->totalKilometers;
        $rent->coordinates = $request->coordinates;
        $rent->save();

        return response()->json(['message' => 'Location updated successfully.']);
    }

    public function emergency(Request $request, $id)
    {

        $request->validate([
            'emergency' => 'required|numeric'
        ]);

        // Step 1: Send the cURL request (before saving data)
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://9a5af1e7-7c18-4bf4-9eff-e240de9055a2.pushnotifications.pusher.com/publish_api/v1/instances/9a5af1e7-7c18-4bf4-9eff-e240de9055a2/publishes",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer CB820096D2CE8541F2712E624FA037B3BC425952854E10E0F0FD4F983923591B"
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                "interests" => ["emergency"],
                "web" => [
                    "notification" => [
                        "title" => "emergency",
                        "body" => "Emergency alert!",
                        "deep_link" => "http://grey-marten-935587.hostingersite.com/track/" .  $id
                    ]
                ]
            ]),
            CURLOPT_SSL_VERIFYPEER => false, // Disable SSL verification (for local/dev environments)
        ]);

        $response = curl_exec($curl);
        if(curl_errno($curl)) {
            echo 'cURL error: ' . curl_error($curl);
        }
        curl_close($curl);

        // Step 2: Validate the request
        $request->validate([
            'emergency' => 'required|numeric',
        ]);

        // Step 3: Find the Rent model and update it

        $rent = Rent::findOrFail($id);
        $rent->emergency = $request->emergency;
        $rent->save();

        return response()->json(['message' => 'Emergency status updated successfully.']);
    }

    public function fetchRents(Request $request)
    {

        $driver = Auth::user(); // This will get the currently authenticated driver using the token.

        if (!$driver) {
            // If no authenticated driver is found, return an error response
            return response()->json(['error' => 'Driver not authenticated'], 401);
        }

        // Fetch ongoing rents for the authenticated driver
        $rents = Rent::where('driver_id', $driver->id)  // Assuming the rents table has a 'driver_id' field
                    ->where('status', 'ongoing')       // Assuming the rents table has a 'status' field
                    ->with('vehicle')
                    ->get();

        // Return the rents in the response
        return response()->json([
            'rents' => $rents
        ]);
    }

    public function driverHistory($driverId)
    {
        // Fetch all completed and cancelled rents for a specific driver
        $rents = Rent::where('driver_id', $driverId)
                    ->whereIn('status', ['completed', 'cancelled'])
                    ->get();

        // Fetch the driver information
        $driver = Driver::findOrFail($driverId);

        // Pass data to the view
        return view('rents.driverhistory', compact('rents', 'driver'));
    }

    public function driverReport()
    {
         // Group rents by driver
    $rents = Rent::whereIn('status', ['completed', 'cancelled'])
    ->with('driver')  // Eager load the driver relationship
    ->get()
    ->groupBy(function($rent) {
        return $rent->driver->id;  // Group rents by driver ID
    });

        return view('rents.driverport', compact('rents'));
    }
    
    public function emergencyIndex()
    {
    $emergencyRents = Rent::where('emergency', 1)->get();
    return view('rents.emergency', compact('emergencyRents'));
    }

}