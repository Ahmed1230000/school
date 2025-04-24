@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Role: {{ $role->name }}</h2>

        <!-- Permissions -->
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Assigned Permissions</h3>
        <ul class="list-disc list-inside">
            @foreach($role->permissions as $permission)
                <li class="text-gray-700">{{ $permission->name }}</li>
            @endforeach
        </ul>

        <div class="mt-6">
            <a href="{{ route('roles.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Back to Roles</a>
        </div>
    </div>
</div>
@endsection
