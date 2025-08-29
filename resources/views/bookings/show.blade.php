@extends('layout')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-10">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-700 text-center md:text-left flex-1">Booking Details</h2>
            <div class="flex gap-3 justify-center md:justify-end mt-4 md:mt-0">
                <a href="{{ route('bookings.edit', $booking->id) }}" class="py-2 px-5 bg-blue-600 text-lg font-bold text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    @csrf
                    @method('DELETE')
                    <button class="py-2 px-5 bg-red-600 text-lg font-bold text-white rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-col items-center space-y-4">
            <h3 class="text-2xl font-semibold text-gray-800">{{ $booking->client_name }}</h3>
            <p class="text-xl"><span class="font-bold">Event Type:</span> {{ $booking->event_type }}</p>
            <p class="text-xl"><span class="font-bold">Event Date:</span> {{ \Carbon\Carbon::parse($booking->event_date)->format('F j, Y') }}</p>
            <p class="text-xl"><span class="font-bold">Location:</span> {{ $booking->location }}</p>
            @if($booking->notes)
            <p class="text-xl"><span class="font-bold">Notes:</span> {{ $booking->notes }}</p>
            @endif
            <p class="text-xl">
                <span class="font-bold">Status:</span>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $booking->status }}
                </span>
            </p>
        </div>
    </div>
</div>
@endsection