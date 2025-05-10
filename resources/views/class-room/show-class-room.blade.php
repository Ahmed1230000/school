@extends('layouts.app')

@section('content')
<div class="pt-8 pb-12 px-6 sm:px-8 lg:px-12 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-200 to-green-100 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                            <svg class="h-6 w-6 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Classroom Details
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">View the details of {{ $classRoom->name }}.</p>
                    </div>
                    <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Classrooms
                    </a>
                </div>
            </div>

            <!-- Classroom, Teachers, and Students Details -->
            <div class="px-6 py-8 sm:px-8">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->name }}</p>
                        </div>

                        <!-- Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Code</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->code ?? 'N/A' }}</p>
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Capacity</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->capacity ?? 'N/A' }}</p>
                        </div>

                        <!-- Floor -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Floor</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->floor ?? 'N/A' }}</p>
                        </div>

                        <!-- Building -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Building</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->building ?? 'N/A' }}</p>
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type</label>
                            <p class="mt-1 text-gray-900">{{ $classRoom->type ?? 'N/A' }}</p>
                        </div>

                        <!-- Teacher Information -->
                        <div class="col-span-2">
                            <h3 class="text-xl font-semibold text-gray-800 mt-4">Teacher Information</h3>
                            @if ($classRoom->teachers->isEmpty())
                            <p class="mt-4 text-gray-600">No teachers assigned to this classroom.</p>
                            @else
                            <div class="mt-4 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($classRoom->teachers as $teacher)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->subject ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $teacher->phone ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>

                        <!-- Student Information -->
                        <div class="col-span-2">
                            <h3 class="text-xl font-semibold text-gray-800 mt-4">Student Information</h3>
                            @if ($classRoom->students->isEmpty())
                            <p class="mt-4 text-gray-600">No students assigned to this classroom.</p>
                            @else
                            <div class="mt-4 overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($classRoom->students as $student)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->full_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->grade ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->phone ?? 'N/A' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end mt-8 space-x-3">
                    <a href="{{ route('classrooms.edit', $classRoom->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Classroom
                    </a>
                    <form action="{{ route('classrooms.destroy', $classRoom->id) }}" method="POST" class="inline-flex">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this classroom?')">
                            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Delete Classroom
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection