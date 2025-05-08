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
              Edit Teacher Details
            </h2>
            <p class="text-sm text-gray-600 mt-1">Update the teacher's information below.</p>
          </div>
          <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Teachers
          </a>
        </div>
      </div>

      @include('components.alerts')

      <!-- Form -->
      <div class="px-6 py-8 sm:px-8">
        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="space-y-6">
          @csrf
          @method('PUT')

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
              <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
              <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $teacher->full_name) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('full_name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Date of Birth -->
            <div>
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
              <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $teacher->date_of_birth) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('date_of_birth')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Gender -->
            <div>
              <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
              <select name="gender" id="gender"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white appearance-none">
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Female</option>
              </select>
              @error('gender')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('email')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Phone -->
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
              <input type="tel" name="phone" id="phone" value="{{ old('phone', $teacher->phone) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('phone')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Subject -->
            <div>
              <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
              <input type="text" name="subject" id="subject" value="{{ old('subject', $teacher->subject) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('subject')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Hire Date -->
            <div>
              <label for="hire_date" class="block text-sm font-medium text-gray-700 mb-1">Hire Date</label>
              <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', $teacher->hire_date) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('hire_date')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Qualification -->
            <div>
              <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1">Qualification</label>
              <input type="text" name="qualification" id="qualification" value="{{ old('qualification', $teacher->qualification) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('qualification')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Experience -->
            <div>
              <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
              <input type="text" name="experience" id="experience" value="{{ old('experience', $teacher->experience) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('experience')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Address -->
            <div>
              <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
              <input type="text" name="address" id="address" value="{{ old('address', $teacher->address) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('address')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Emergency Contact Name -->
            <div>
              <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name</label>
              <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name', $teacher->emergency_contact_name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('emergency_contact_name')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Emergency Contact Phone -->
            <div>
              <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Phone</label>
              <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone', $teacher->emergency_contact_phone) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
              @error('emergency_contact_phone')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Students -->
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-1">Assign Students</label>
              <input type="hidden" name="students[]" value="">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-40 overflow-y-auto p-4 border border-gray-300 rounded-md bg-white">
                @php
                $selectedStudents = old('students', $teacher->students->pluck('id')->toArray());
                @endphp
                @foreach ($students as $student)
                <label class="flex items-center space-x-2">
                  <input type="checkbox" name="students[]" value="{{ $student->id }}"
                    {{ in_array($student->id, $selectedStudents) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-300 border-gray-300 rounded">
                  <span class="text-sm text-gray-700">{{ $student->full_name }}</span>
                </label>
                @endforeach
              </div>
              @error('students')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

          </div>

          <!-- Buttons -->
          <div class="flex justify-end mt-8 space-x-3">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
              <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Update Teacher
            </button>
            <a href="{{ route('teachers.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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

<style>
  select {
    background-image: url("data:image/svg+xml;utf8,<svg fill='gray' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.5rem;
  }

  .max-h-40 {
    max-height: 10rem;
  }
</style>
@endsection