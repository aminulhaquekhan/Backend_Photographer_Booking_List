<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Photographers;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the bookings.
     */
    public function index()
    {
        $bookings = Booking::latest()->get(); // or paginate if needed
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $photographers = Photographers::all();
        return view('bookings.create', compact('photographers'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        // Validate the form input (this will automatically redirect back with errors if validation fails)
        $validatedData = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'required|string|max:20',
            'event_type'       => 'required|string|max:255',
            'event_date'       => 'required|date|after_or_equal:today',
            'location'         => 'required|string|max:255',
            'photographer_id'  => 'nullable|exists:photographers,id',
            'special_requests' => 'nullable|string',
        ]);

        // Create booking using validated data
        Booking::create($validatedData);

        // Redirect to booking index with success message
        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }
    /**
     * Display the specified booking.
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        $photographers = Photographers::all();
        return view('bookings.edit', compact('booking', 'photographers'));
    }

    /**
     * Update the specified booking in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'customer_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'event_type' => 'required|string|max:255',
        'event_date' => 'required|date',
        'location' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified booking from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}