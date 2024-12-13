<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
//Modified
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;
// use Laravel\Sanctum\HasApiTokens;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers',
            'contact' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|integer|min:18',
            'birthday' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ]);
        //$data['password'] = bcrypt($data['password']);
        $data['password'] = $request->password;

        Driver::create($data);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'contact' => 'required|string|max:15',
            'address' => 'required|string',
            'age' => 'required|integer|min:18',
            'birthday' => 'required|date',
        ]);

        $driver->update($data);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }

    public function toggleStatus(Driver $driver)
    {
        $driver->is_active = !$driver->is_active;
        $driver->save();

        return redirect()->route('drivers.index')->with('success', 'Driver status updated successfully.');
    }

    public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }
    
    //     // Find the driver by email
    //     $driver = Driver::where('email', $request->email)->first();
        
    //     // Check if the driver exists
    //     if (!$driver) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
    
    //     // Verify the password
    //     if (!Hash::check($request->password, $driver->password)) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }
    
    //     // Generate a token
    //     $token = $driver->createToken('authToken')->plainTextToken;
    
    //     return response()->json(['token' => $token], 200);
    // }
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    
        $driver = Driver::where('email', $credentials['email'])->first();
    
        if (!$driver || !Hash::check($credentials['password'], $driver->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        // Generate token
        $token = $driver->createToken('driver-token')->plainTextToken;
    
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'driver' => $driver,
        ]);
    }

    public function logout(Request $request)
    {
        $request->driver()->currentAccessToken()->delete();
        
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
    public function updateLocation(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driver = Driver::findOrFail($id);
        $driver->latitude = $request->latitude;
        $driver->longitude = $request->longitude;
        $driver->save();

        return response()->json(['message' => 'Location updated successfully.']);
    }
    public function profile(Request $request)
    {
        // Get the authenticated driver
        $driver = Auth::user(); // Assumes you're using Laravel's built-in authentication

        // Return the driver's information
        return response()->json([
            'driver' => [
                'firstName' => $driver->firstname, // Adjust field names as necessary
                'lastName' => $driver->lastname,
                'email' => $driver->email,
                'age' => $driver->age,
                'birthdate' => $driver->birthday,
            ]
        ]);
    }
    // Method to get all drivers' locations
    public function getLocations()
    {
        $drivers = Driver::all(['id', 'name', 'latitude', 'longitude']);
        return response()->json($drivers);
    }

    public function longestRoutes()
{
    // Fetch drivers with their longest routes
    $drivers = Driver::with(['rents' => function($query) {
        $query->orderBy('distance_traveled', 'desc'); // Order by distance traveled
    }])->get();

    return view('drivers.longestroutes', compact('drivers'));
}
}