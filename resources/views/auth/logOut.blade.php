<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logout Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-gray-100 min-h-screen flex items-center justify-center">
    <div class="glass-card rounded-xl p-8 max-w-md w-full shadow-lg">
        <div class="text-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <h2 class="text-2xl font-semibold mt-4 text-gray-700">Ready to leave?</h2>
            <p class="text-gray-600 mt-2">You'll need to sign in again to access your account</p>
        </div>
        @if (session('success'))
        <div class="bg-green-400/20 backdrop-blur-md border border-green-500/30 text-green-100 px-4 py-3 rounded-lg mb-6 text-sm animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-400/20 backdrop-blur-md border border-red-500/30 text-red-100 px-4 py-3 rounded-lg mb-6 text-sm animate__animated animate__shakeX">
            {{ session('error') }}
        </div>
        @endif
        <form method="POST" action="{{ route('logout.perform') }}" class="space-y-4">
            @csrf
            <div class="flex justify-center space-x-4">
                <button type="submit" class="btn-hover bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">
                    Sign Out
                </button>
                <a href="/dashboard" class="btn-hover bg-white border border-gray-300 text-gray-700 font-medium py-2 px-6 rounded-lg">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>

</html>