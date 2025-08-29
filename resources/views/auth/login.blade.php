@extends('layout')

@section('content')
<div class="flex items-center justify-center min-h-[90vh] bg-gray-50">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg text-center">
        <h2 class="text-3xl font-bold mb-6 text-blue-600">Welcome Back</h2>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Form --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-left">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Enter your email" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>
            <div class="text-left">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password" 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:-translate-y-1">
                Login
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500">
            Don't have an account? <a href="{{ route('users.create') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>
</div>
@endsection