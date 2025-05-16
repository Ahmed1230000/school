<!-- Add this above the main content if Alpine.js not already added -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@extends('layouts.app')

@section('content')
<div x-data="{ open: false }" class="min-h-screen bg-gray-100 py-10 px-6">
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <div class="flex items-center gap-4">
                <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500">Main Dashboard</p>
                </div>
            </div>
            <span class="text-sm text-gray-400">Today: {{ now()->format('Y-m-d') }}</span>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-50 p-5 rounded border">
                <h3 class="text-gray-700 font-semibold mb-2">Total Students</h3>
                <p class="text-3xl text-blue-600 font-bold">{{ \App\Models\Student::count() }}</p>
            </div>

            <div class="bg-gray-50 p-5 rounded border">
                <h3 class="text-gray-700 font-semibold mb-2">Total Teachers</h3>
                <p class="text-3xl text-green-600 font-bold">{{ \App\Models\Teacher::count() }}</p>
            </div>

            <div class="bg-gray-50 p-5 rounded border">
                <h3 class="text-gray-700 font-semibold mb-2">Total Classes</h3>
                <p class="text-3xl text-purple-600 font-bold">{{ \App\Models\ClassRoom::count() }}</p>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="#" class="bg-blue-50 border border-blue-200 hover:bg-blue-100 text-blue-800 text-center p-4 rounded transition-all">
                Register New Student
            </a>
            <a href="#" class="bg-green-50 border border-green-200 hover:bg-green-100 text-green-800 text-center p-4 rounded transition-all">
                Upload Student Grades
            </a>

            <!-- Button to open modal -->
            <button @click="open = true" class="bg-gray-50 border border-gray-300 text-gray-800 text-center p-4 rounded transition-all hover:bg-gray-100">
                System Settings
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div @click.away="open = false" class="bg-white w-full max-w-md p-6 rounded shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-4 text-center">System Settings</h2>
            <div class="space-y-3">
                <a href="{{ route('roles.index') }}" class="block text-indigo-700 hover:underline text-center">Manage Roles</a>
                <a href="{{ route('permissions.index') }}" class="block text-yellow-700 hover:underline text-center">Manage Permissions</a>
            </div>
            <div class="mt-6 text-center">
                <button @click="open = false" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection