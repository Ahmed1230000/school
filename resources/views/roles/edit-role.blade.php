@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <!-- Page Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Role: {{ $role->name }}</h2>

        <!-- Validation Errors -->
        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('success'))
        <div class="max-w-3xl mx-auto mt-6">
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="max-w-3xl mx-auto mt-6">
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md">
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Role Edit Form -->
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Role Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter role name" required>
            </div>
            <div class="flex items-center gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Update Role</button>
                <a href="{{ route('roles.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection