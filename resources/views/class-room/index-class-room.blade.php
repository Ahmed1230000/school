{{-- resources/views/dashboard/classrooms/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <svg class="w-8 h-8 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
                Classroom Management
            </h1>
            <p class="text-gray-500 mt-1">Manage all classrooms in one place</p>
        </div>

        <a href="{{ route('classrooms.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-sm">
            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Classroom
        </a>
    </div>

    <!-- Classroom Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capacity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Floor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Building</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($classRooms as $classRoom)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $classRoom->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $classRoom->code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $classRoom->capacity }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $classRoom->floor }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $classRoom->building }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $classRoom->type }}</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                {{ $classRoom->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($classRoom->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-3">
                                <a href="{{ route('classrooms.edit', $classRoom->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                    ✏️
                                </a>
                                <a href="{{ route('classrooms.show', $classRoom->id) }}" class="text-green-600 hover:text-green-900" title="View">
                                    👁️
                                </a>
                                <form action="{{ route('classrooms.destroy', $classRoom->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this classroom?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-12 text-center text-gray-400">
                            No classrooms found. <a href="{{ route('classrooms.create') }}" class="text-indigo-600 hover:underline">Add one</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection