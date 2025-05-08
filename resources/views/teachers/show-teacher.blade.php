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
                Teacher Details
              </h2>
              <p class="text-sm text-gray-600 mt-1">View the details of {{ $teacher->full_name }}.</p>
            </div>
            <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
              <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Back to Teachers
            </a>
          </div>
        </div>

        <!-- Teacher Details -->
        <div class="px-6 py-8 sm:px-8">
          <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <!-- Full Name -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                <p class="mt-1 text-gray-900">{{ $teacher->full_name }}</p>
              </div>

              <!-- Gender -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Gender</label>
                <p class="mt-1 text-gray-900">{{ ucfirst($teacher->gender) }}</p>
              </div>

              <!-- Date of Birth -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($teacher->date_of_birth)->format('d/m/Y') }}</p>
              </div>

              <!-- Hire Date -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Hire Date</label>
                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($teacher->hire_date)->format('d/m/Y') }}</p>
              </div>

              <!-- Subject -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Subject</label>
                <p class="mt-1 text-gray-900">{{ $teacher->subject }}</p>
              </div>

              <!-- Phone -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <p class="mt-1 text-gray-900">{{ $teacher->phone }}</p>
              </div>

              <!-- Email -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <p class="mt-1 text-gray-900">{{ $teacher->email }}</p>
              </div>

              <!-- Qualification -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Qualification</label>
                <p class="mt-1 text-gray-900">{{ $teacher->qualification }}</p>
              </div>

              <!-- Experience -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Experience</label>
                <p class="mt-1 text-gray-900">{{ $teacher->experience }}</p>
              </div>

              <!-- Address -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <p class="mt-1 text-gray-900">{{ $teacher->address }}</p>
              </div>

              <!-- Emergency Contact -->
              <div>
                <label class="block text-sm font-medium text-gray-700">Emergency Contact</label>
                <p class="mt-1 text-gray-900">{{ $teacher->emergency_contact_name }} ({{ $teacher->emergency_contact_phone }})</p>
              </div>

              <!-- Assigned Students -->
              <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Assigned Students</label>
                <div class="mt-1 p-4 border border-gray-300 rounded-md bg-white">
                  @if ($teacher->students->isEmpty())
                    <p class="text-sm text-gray-600">No students assigned.</p>
                  @else
                    <ul class="list-disc pl-5 space-y-1">
                      @foreach ($teacher->students as $student)
                        <li class="text-sm text-gray-900">{{ $student->full_name }}</li>
                      @endforeach
                    </ul>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end mt-8 space-x-3">
            <a href="{{ route('teachers.edit', $teacher->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit Teacher
            </a>
            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" class="inline-flex">
              @csrf
              @method('DELETE')
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this teacher?')">
                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Delete Teacher
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection