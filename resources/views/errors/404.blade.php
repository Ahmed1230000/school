@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 via-gray-50 to-blue-200 px-6 sm:px-8 lg:px-12" x-data="{ loaded: false }" x-init="loaded = true">
    <div class="max-w-4xl mx-auto text-center">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500" :class="loaded ? 'scale-100 opacity-100' : 'scale-95 opacity-0'">
            <div class="px-6 py-12 sm:px-8 sm:py-16">
                <!-- Animated 404 Icon -->
                <div class="flex justify-center mb-6">
                    <i class="fas fa-exclamation-circle text-8xl text-blue-600 animate-bounce-slow"></i>
                </div>

                <!-- Animated Title -->
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-4"
                    x-show="loaded"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 -translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    404 - Page Not Found
                </h2>

                <!-- Animated Description -->
                <p class="text-lg sm:text-xl text-gray-600 mb-8"
                    x-show="loaded"
                    x-transition:enter="transition ease-out duration-700 delay-200"
                    x-transition:enter-start="opacity-0 -translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    Oops! Looks like you're lost in space. Let's get you back home.
                </p>

                <!-- Animated Button -->
                <div class="flex justify-center">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-lg font-medium rounded-md shadow-lg hover:bg-blue-700 hover:scale-105 transform transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-300 animate-pulse-slow">
                        <i class="fas fa-home mr-2"></i> Go Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom Animation for Slow Bounce */
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite;
    }

    @keyframes bounce-slow {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    /* Custom Animation for Slow Pulse */
    .animate-pulse-slow {
        animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse-slow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.85;
        }
    }
</style>
@endpush
@endsection