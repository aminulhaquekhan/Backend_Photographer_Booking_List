@extends('layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">All Bookings</h1>
        <a href="{{ route('bookings.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Add Booking
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-600">
                <tr>
                    <th class="px-4 py-3">Client Name</th>
                    <th class="px-4 py-3">Event Type</th>
                    <th class="px-4 py-3">Event Date</th>
                    <th class="px-4 py-3">Location</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse ($bookings as $booking)
                <tr>
                    <td class="px-4 py-2">{{ $booking->customer_name }}</td>
                    <td class="px-4 py-2">{{ $booking->event_type }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->event_date)->format('F j, Y') }}</td>
                    <td class="px-4 py-2">{{ $booking->location }}</td>
                    <td class="px-4 py-2">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 space-x-3">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="text-yellow-500 hover:text-yellow-700">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this booking?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No bookings available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection