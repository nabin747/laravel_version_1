<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Booking;

//class CustomerController extends Controller
//{
//    public function index()
//    {
//        $bookings = Booking::all();
//        return response()->json($bookings);
//    }
//
//    public function store(Request $request)
//    {
//        $booking = Booking::create($request->all());
//        return response()->json($booking, 201);
//    }
//
//    public function show($id)
//    {
//        $booking = Booking::find($id);
//        if (!$booking) {
//            return response()->json(['message' => 'Booking not found'], 404);
//        }
//        return response()->json($booking);
//    }
//
//    public function update(Request $request, $id)
//    {
//        $booking = Booking::find($id);
//        if (!$booking) {
//            return response()->json(['message' => 'Booking not found'], 404);
//        }
//        $booking->update($request->all());
//        return response()->json($booking, 200);
//    }
//
//    public function destroy($id)
//    {
//        $booking = Booking::find($id);
//        if (!$booking) {
//            return response()->json(['message' => 'Booking not found'], 404);
//        }
//        $booking->delete();
//        return response()->json(null, 204);
//    }
//
//    // Add other methods for handling Customer-specific API requests here
//}


class CustomerController extends Controller
{
    // Get all Bookings
    public function index()
    {
        $bookings = Booking::all();
        return response()->json($bookings);
    }

    // Create a new Booking
    public function store(Request $request)
    {
        $request->validate([
            'field_name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        $booking = Booking::create($request->all());
        return response()->json($booking, 201);
    }

    // Get a single Booking by ID
    public function show($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }
        return response()->json($booking);
    }

    // Update a Booking by ID
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $request->validate([
            'field_name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        $booking->update($request->all());
        return response()->json($booking, 200);
    }

    // Delete a Booking by ID
    public function destroy($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(null, 204);
    }
}
