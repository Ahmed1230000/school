@extends('layouts.app')

@section('content')
<div class="pt-8 pb-12 px-6 sm:px-8 lg:px-12 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-200 to-yellow-100 px-6 py-5 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                            <svg class="h-6 w-6 mr-2 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                            </svg>
                            Edit Classroom Details
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Update the classroom's information below.</p>
                    </div>
                    <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Classrooms
                    </a>
                </div>
            </div>

            <!-- Flash Messages + Validation Errors -->
            @include('components.alerts')

            <!-- Form -->
            <div class="px-6 py-8 sm:px-8">
                <form action="{{ route('classrooms.update', $classRoom->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Classroom Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Classroom Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $classRoom->name) }}"
                                required maxlength="100"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Classroom Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Classroom Code *</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $classRoom->code) }}"
                                required maxlength="50"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('code')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Capacity -->
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity (Max 30)</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $classRoom->capacity) }}"
                                min="1" max="30"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('capacity')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Floor -->
                        <div>
                            <label for="floor" class="block text-sm font-medium text-gray-700 mb-1">Floor</label>
                            <input type="number" name="floor" id="floor" value="{{ old('floor', $classRoom->floor) }}"
                                min="0" max="10"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('floor')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Building -->
                        <div>
                            <label for="building" class="block text-sm font-medium text-gray-700 mb-1">Building</label>
                            <input type="text" name="building" id="building" value="{{ old('building', $classRoom->building) }}"
                                maxlength="100"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('building')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <input type="text" name="type" id="type" value="{{ old('type', $classRoom->type) }}"
                                maxlength="50"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300" />
                            @error('type')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300 bg-white">
                                <option value="">Select Status</option>
                                @foreach(\App\Enum\ClassStatus::cases() as $status)
                                <option value="{{ $status->value }}" {{ old('status', $classRoom->status) === $status->value ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status->value)) }}
                                </option>
                                @endforeach
                            </select>
                            @error('status')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teachers Selection (Checkboxes) -->
                        <div class="sm:col-span-2">
                            <label for="teachers" class="block text-sm font-medium text-gray-700 mb-1">Assign Teachers</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-2 border border-gray-300 rounded-md">
                                @forelse ($teachers as $teacher)
                                <div class="flex items-center">
                                    <input type="checkbox" name="teachers[]" value="{{ $teacher->id }}" id="teacher_{{ $teacher->id }}"
                                        {{ in_array($teacher->id, old('teachers', $classRoom->teachers->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-2 focus:ring-purple-300" />
                                    <label for="teacher_{{ $teacher->id }}" class="ml-2 text-sm text-gray-700">{{ $teacher->full_name }}</label>
                                </div>
                                @empty
                                <p class="text-sm text-gray-500">No teachers available.</p>
                                @endforelse
                            </div>
                            @error('teachers')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Students Selection (Checkboxes) -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assign Students</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-2 border border-gray-300 rounded-md">
                                @forelse ($students as $student)
                                <div class="flex items-center">
                                    <input type="checkbox" name="students[]" value="{{ $student->id }}" id="student_{{ $student->id }}"
                                        {{ in_array($student->id, old('students', $classRoom->students->pluck('id')->toArray())) ? 'checked' : '' }}
                                        class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-2 focus:ring-purple-300" />
                                    <label for="student_{{ $student->id }}" class="ml-2 text-sm text-gray-700">{{ $student->full_name }}</label>
                                </div>
                                @empty
                                <p class="text-sm text-gray-500">No students available.</p>
                                @endforelse
                            </div>
                            @error('students')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">{{ old('description', $classRoom->description) }}</textarea>
                            @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end mt-8 space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Classroom
                        </button>
                        <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for select arrow -->
<style>
    select {
        background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1.5rem;
    }
</style>
@endsection