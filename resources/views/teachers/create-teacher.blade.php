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
                            Add New Teacher
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Enter the teacher's information to register them.</p>
                    </div>
                    <a href="{{ route('teachers.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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
                <form action="{{ route('teachers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('full_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('date_of_birth')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                            <select name="gender" id="gender" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 appearance-none bg-white">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('phone')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hire Date -->
                        <div>
                            <label for="hire_date" class="block text-sm font-medium text-gray-700 mb-1">Hire Date *</label>
                            <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('hire_date')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Qualification -->
                        <div>
                            <label for="qualification" class="block text-sm font-medium text-gray-700 mb-1">Qualification *</label>
                            <input type="text" name="qualification" id="qualification" value="{{ old('qualification') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('qualification')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('subject')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Experience -->
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience *</label>
                            <input type="text" name="experience" id="experience" value="{{ old('experience') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('experience')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('address')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Emergency Contact Name -->
                        <div>
                            <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Name *</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="{{ old('emergency_contact_name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('emergency_contact_name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Emergency Contact Phone -->
                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact Phone *</label>
                            <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                            @error('emergency_contact_phone')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Materials Section -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Materials *</label>
                            <div id="materials-container" class="space-y-4 p-4 border border-gray-300 rounded-md bg-white">
                                <!-- Material Template (Hidden) -->
                                <div class="material-item hidden" id="material-template">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Material Name *</label>
                                            <input type="text" name="materials[][name]" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Material Description *</label>
                                            <input type="text" name="materials[][description]" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                                        </div>
                                    </div>
                                    <button type="button" class="remove-material mt-2 text-sm text-red-600 hover:text-red-800">Remove Material</button>
                                </div>
                                <!-- Initial Material Field -->
                                <div class="material-item">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Material Name *</label>
                                            <input type="text" name="materials[0][name]" value="{{ old('materials.0.name') }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" required />
                                            @error('materials.0.name')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <input type="text" name="materials[0][description]" value="{{ old('materials.0.description') }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300" />
                                            @error('materials.0.description')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="button" class="remove-material mt-2 text-sm text-red-600 hover:text-red-800 hidden">Remove Material</button>
                                </div>
                            </div>
                            <button type="button" id="add-material" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                                <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Material
                            </button>
                            @error('materials')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Students -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Assign Students</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-40 overflow-y-auto p-4 border border-gray-300 rounded-md bg-white">
                                @foreach ($students as $student)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="students[]" value="{{ $student->id }}"
                                        {{ in_array($student->id, old('students', [])) ? 'checked' : '' }}
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
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Teacher
                        </button>
                        <a href="{{ route('teachers.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addButton = document.getElementById('add-material');
        const container = document.getElementById('materials-container');
        const template = document.getElementById('material-template');

        if (!addButton || !container || !template) {
            console.error('Missing required elements:', {
                addButton: !!addButton,
                container: !!container,
                template: !!template
            });
            return;
        }

        addButton.addEventListener('click', function() {
            const materialItems = container.querySelectorAll('.material-item:not(#material-template)');
            const index = materialItems.length;
            const clone = template.cloneNode(true);

            clone.querySelectorAll('input').forEach(input => {
                const name = input.name.replace(/(\[\]|\[\d+\])/, `[${index}]`);
                input.name = name;
                input.value = '';
                if (name.includes('[name]')) {
                    input.setAttribute('required', 'required');
                } else {
                    input.removeAttribute('required');
                }
            });

            clone.classList.remove('hidden');
            clone.id = '';
            container.appendChild(clone);

            const removeButtons = container.querySelectorAll('.remove-material');
            if (materialItems.length >= 1) {
                removeButtons.forEach(btn => btn.classList.remove('hidden'));
            }

            console.log(`Added material with index ${index}`);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-material')) {
                const item = e.target.closest('.material-item');
                if (item) {
                    item.remove();

                    const materialItems = container.querySelectorAll('.material-item:not(#material-template)');
                    materialItems.forEach((item, index) => {
                        item.querySelectorAll('input').forEach(input => {
                            const name = input.name.replace(/materials\[\d+\]/g, `materials[${index}]`);
                            input.name = name;
                        });
                    });

                    const removeButtons = container.querySelectorAll('.remove-material');
                    if (materialItems.length <= 1) {
                        removeButtons.forEach(btn => btn.classList.add('hidden'));
                    }

                    console.log(`Removed material, re-indexed to ${materialItems.length} items`);
                }
            }
        });

        const form = container.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                const materialItems = container.querySelectorAll('.material-item:not(#material-template)');
                materialItems.forEach(item => {
                    const nameInput = item.querySelector('input[name$="[name]"]');
                    if (!nameInput.value.trim()) {
                        item.remove();
                    }
                });
                console.log(`Cleaned up empty materials before submission`);
            });
        }
    });
</script>
@endsection