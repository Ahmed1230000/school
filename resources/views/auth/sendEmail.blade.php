<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Recovery | Glass Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 12px 48px 0 rgba(31, 38, 135, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg,rgb(48, 50, 83) 0%,rgb(90, 94, 176) 50%,rgb(126, 155, 161) 100%);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .input-glow:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }

        .water-drop {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: dropAnimation 4s infinite ease-in-out;
        }

        @keyframes dropAnimation {

            0%,
            100% {
                transform: translateY(0) scale(1);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-10px) scale(1.05);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center gradient-bg relative overflow-hidden">

    <!-- Water drops decoration -->
    <div class="water-drop" style="width: 80px; height: 80px; top: 15%; left: 20%; animation-delay: 0.5s;"></div>
    <div class="water-drop" style="width: 60px; height: 60px; top: 25%; right: 15%; animation-delay: 1s;"></div>
    <div class="water-drop" style="width: 40px; height: 40px; bottom: 20%; left: 25%; animation-delay: 1.5s;"></div>

    <!-- Main Form Container -->
    <div class="glass-effect w-full max-w-md p-10 text-white relative z-10 mx-4">
        <!-- Animated Icon -->
        <div class="flex justify-center mb-8">
            <div class="floating w-20 h-20 rounded-full bg-white/10 border-2 border-white/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-center mb-4 tracking-wide">Password Recovery</h2>
        <p class="text-center text-white/80 mb-8">
            Enter your email to receive a reset link
        </p>

        @if (session('status'))
        <div class="bg-green-400/20 text-green-100 px-4 py-3 rounded-lg mb-6 border border-green-300/30">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-red-400/20 text-red-100 px-4 py-3 rounded-lg mb-6 border border-red-300/30">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Your Email Address"
                    class="w-full bg-white/10 border border-white/20 rounded-xl py-3 pl-10 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/40 input-glow transition duration-300">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02]">
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-6 text-white/80">
            Remember your password?
            <a href="{{ route('login') }}" class="text-white font-medium hover:underline hover:text-white/90 transition">Back to Login</a>
        </div>
    </div>

    <script>
        // Add ripple effect to buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function(e) {
                const x = e.clientX - e.target.getBoundingClientRect().left;
                const y = e.clientY - e.target.getBoundingClientRect().top;

                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;
                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        });
    </script>
</body>

</html>