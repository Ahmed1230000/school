@extends('layouts.app')

@section('content')
<div class="pt-8 pb-12 px-6 sm:px-8 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-400 px-8 py-6 border-b border-blue-300">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <h2 class="text-3xl font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Roles Management
                    </h2>
                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('roles.create') }}" class="inline-flex items-center px-5 py-2.5 bg-white bg-opacity-20 hover:bg-opacity-30 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            Create Role
                        </a>
                        <a href="{{ route('assign-role-to-user.create') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Assign Role To User
                        </a>
                        <a href="{{ route('assign-permission-to-role.show') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Assign Permission To Role
                        </a>
                        <a href="{{ route('revoke-role-from-user.show') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Revoke Role From User
                        </a>
                        <a href="{{ route('revoke-permission-from-role.show') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 border border-transparent rounded-lg font-medium text-white text-base transition duration-200 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Revoke Permission From Role
                        </a>
                    </div>
                </div>
            </div>

            <!-- Flash Message -->
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

            <!-- Roles Table -->
            <div class="px-8 py-8">
                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Role ID</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Role Name</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Permissions</th>
                                <th scope="col" class="px-8 py-4 text-center text-sm font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($roles as $role)
                            <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-8 py-5 text-base text-gray-500">
                                       <div class="flex flex-wrap gap-3">
                                           @forelse($role->users ?? [] as $user)
                                           <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 shadow-sm">
                                               {{ $user->name }}
                                           </span>
                                           @empty
                                           <span class="text-gray-400 text-sm">No users assigned</span>
                                           @endforelse
                                       </div>
                                   </td>
                                <td class="px-8 py-5 whitespace-nowrap text-base font-medium text-gray-900">{{ $role->id }}</td>
                                <td class="px-8 py-5 whitespace-nowrap text-base font-semibold text-gray-900">{{ $role->name }}</td>
                                <td class="px-8 py-5 text-base text-gray-500">
                                    <div class="flex flex-wrap gap-3">
                                        @forelse($role->permissions as $permission)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 shadow-sm">
                                            {{ $permission->name }}
                                        </span>
                                        @empty
                                        <span class="text-gray-400 text-sm"> No permissions assigned</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-base font-medium text-center">
                                    <div class="flex justify-center space-x-6">
                                        <a href="{{ route('roles.show', $role->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200 transform hover:scale-110" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-200 transform hover:scale-110" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition duration-200 transform hover:scale-110" title="Delete" onclick="return confirmDelete(event, 'Are you sure you want to delete this role?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-6 text-center text-base text-gray-500">No roles found. Create your first role to get started.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-5 border-t border-gray-200 flex justify-end">
                <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function confirmDelete(event, message) {
        event.preventDefault();
        if (confirm(message)) {
            event.target.closest('form').submit();
        }
        return false;
    }
</script>
@endsection
@endsection