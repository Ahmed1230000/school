<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md transition-all duration-300">
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6 tracking-wide">OTP Verification</h2>

        <!-- Flash Messages -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
        @endif

        @if (session('status'))
        <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded mb-4 text-sm">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Enter 6-digit OTP</label>
                <input type="text" name="otp_code" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                    pattern="\d{6}" title="Please enter a 6-digit OTP code"
                    maxlength="6" inputmode="numeric">
            </div>

            <button type="submit"
                class="mt-2 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 transform hover:scale-105">
                Verify OTP
            </button>
        </form>

        <!-- 🟢 هذا هو الفورم الصحيح للـ Resend -->
        <div class="flex justify-between text-sm items-center mt-4">
            <p class="text-gray-600">Didn't get the OTP?</p>

            <form method="POST" action="{{ route('otp.resend', ['user_id' => $user->id]) }}">
                @csrf
                <button
                    type="submit"
                    id="resendBtn"
                    class="resend-btn text-indigo-600 hover:text-indigo-700 font-semibold ml-2">
                    Resend OTP
                </button>
            </form>
        </div>


        <p class="text-center text-sm text-gray-600 mt-6">
            Back to
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Login</a>
        </p>
    </div>

    <script>
        const resendBtn = document.getElementById('resendBtn');
        const RESEND_DELAY = 60;
        const STORAGE_KEY = 'otp_resend_timestamp';

        function getRemainingTime() {
            const lastSent = localStorage.getItem(STORAGE_KEY);
            if (!lastSent) return 0;
            const elapsed = Math.floor((Date.now() - parseInt(lastSent)) / 1000);
            return Math.max(0, RESEND_DELAY - elapsed);
        }

        function startTimer(duration) {
            let timer = duration;

            function update() {
                if (timer > 0) {
                    resendBtn.textContent = `Resend OTP in ${timer}s`;
                    resendBtn.classList.add('text-gray-400', 'cursor-not-allowed');
                    resendBtn.classList.remove('text-indigo-600', 'hover:text-indigo-700');
                    resendBtn.disabled = true;
                    timer--;
                    setTimeout(update, 1000);
                } else {
                    resendBtn.textContent = 'Resend OTP';
                    resendBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
                    resendBtn.classList.add('text-indigo-600', 'hover:text-indigo-700');
                    resendBtn.disabled = false;
                }
            }

            update();
        }

        resendBtn.addEventListener('click', function() {
            if (!resendBtn.classList.contains('cursor-not-allowed')) {
                localStorage.setItem(STORAGE_KEY, Date.now().toString());
            }
        });

        const remaining = getRemainingTime();
        if (remaining > 0) {
            startTimer(remaining);
        }
    </script>

</body>

</html>