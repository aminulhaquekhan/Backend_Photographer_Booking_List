@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-8 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Booking</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Client Name</label>
            <input type="text" name="customer_name" value="{{ old('customer_name', $booking->customer_name) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Event Type</label>
            <input type="text" name="event_type" value="{{ old('event_type', $booking->event_type) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Event Date</label>
            <input type="date" name="event_date" value="{{ old('event_date', $booking->event_date) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Location</label>
            <input type="text" name="location" value="{{ old('location', $booking->location) }}" class="w-full border rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" class="w-full border rounded-lg px-4 py-2" required>
                <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('bookings.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection