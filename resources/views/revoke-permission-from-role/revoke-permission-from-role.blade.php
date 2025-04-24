@extends('layouts.app')

@section('content')
<div class="pt-8 pb-12 px-6 sm:px-8 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-8 py-6 border-b border-indigo-400">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <h2 class="text-3xl font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        Revoke Permissions from Role
                    </h2>
                    <a href="{{ route('roles.index') }}" class="inline-flex items-center px-5 py-2.5 border border-gray-100 shadow-sm text-base font-medium rounded-lg text-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Roles
                    </a>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-400 p-6 mx-8 mt-8 rounded-lg shadow-md transition duration-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-base text-emerald-700">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-4">
                        <button onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="text-emerald-500 hover:text-emerald-700">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-6 mx-8 mt-8 rounded-lg shadow-md transition duration-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <ul class="text-base text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ml-auto pl-4">
                        <button onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="text-red-500 hover:text-red-700">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Form -->
            <div class="px-8 py-8">
                <form id="revokePermissionForm" action="{{ route('revoke-permission-from-role.revoke') }}" method="POST">
                    @csrf
                    <div class="space-y-8">
                        <!-- Role Selection -->
                        <div>
                            <label for="role_id" class="block text-gray-700 font-medium mb-2 text-base">Select Role</label>
                            <select id="role_id" name="role_id" required class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" disabled selected>Select a Role</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Permission Selection using checkboxes -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-3 text-base">Select Permissions to Revoke</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($permissions as $permission)
                                <label for="permission_{{ $permission->id }}" class="inline-flex items-center bg-gray-50 border {{ $errors->has('permissions.*') && !in_array($permission->name, old('permissions', [])) ? 'border-red-600' : 'border-gray-200' }} rounded-lg shadow-sm px-4 py-2 hover:bg-gray-100 transition duration-200">
                                    <input
                                        type="checkbox"
                                        id="permission_{{ $permission->id }}"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        class="form-checkbox h-5 w-5 text-indigo-600 focus:ring-indigo-500"
                                        {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700 text-base">{{ $permission->name }}</span>
                                </label>
                                @endforeach
                            </div>
                            @error('permissions')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('permissions.*')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Revoke Permissions from Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.getElementById('revokePermissionForm').addEventListener('submit', function(e) {
        const permissions = document.querySelectorAll('input[name="permissions[]"]:checked');
        if (permissions.length === 0) {
            e.preventDefault();
            const errorMessage = document.createElement('div');
            errorMessage.className = 'bg-red-50 border-l-4 border-red-400 p-6 mx-8 mt-8 rounded-lg shadow-md transition duration-300';
            errorMessage.innerHTML = `
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-base text-red-700">Please select at least one permission to revoke.</p>
                    </div>
                    <div class="ml-auto pl-4">
                        <button onclick="this.parentElement.parentElement.parentElement.style.display='none'" class="text-red-500 hover:text-red-700">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            document.querySelector('.px-8.py-8').prepend(errorMessage);
        } else {
            const selectedPermissions = Array.from(permissions).map(input => input.value);
            console.log('Selected Permissions to Revoke:', selectedPermissions);
        }
    });
</script>
@endsection
@endsection