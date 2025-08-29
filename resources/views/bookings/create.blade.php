@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Create New Booking</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong class="font-bold">Whoops!</strong> Please correct the following errors:
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="customer_name" class="block text-sm font-medium text-gray-700">Client Name</label>
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer  _name') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
            <input type="text" name="event_type" id="event_type" value="{{ old('event_type') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
            <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <div>
            <label for="notes" class="block text-sm font-medium text-gray-700">Additional Notes</label>
            <textarea name="notes" id="notes" rows="4"
                class="mt-1 w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
        </div>

        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                Book Photographer
            </button>
        </div>
    </form>
</div>
@endsection