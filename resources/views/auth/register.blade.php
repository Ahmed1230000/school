<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modern Glass Register Form</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #6B8DD6 100%);
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
                transform: translateY(-20px);
            }
        }

        .input-glow:focus {
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particle-float linear infinite;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) translateX(20px);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center gradient-bg relative overflow-hidden">

    <!-- Floating Particles Background -->
    <div id="particles-js" class="absolute inset-0"></div>

    <!-- Main Form Container -->
    <div class="glass-effect w-full max-w-md p-10 text-white relative z-10 mx-4">
        <!-- Animated Logo -->
        <div class="flex justify-center mb-8">
            <div class="floating w-20 h-20 rounded-full bg-white/10 border-2 border-white/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                </svg>
            </div>
        </div>

        <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">Join Us Today</h2>

        @if ($errors->any())
        <div class="bg-red-400/20 text-red-100 px-4 py-3 rounded-lg mb-6 border border-red-300/30">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-400/20 text-green-100 px-4 py-3 rounded-lg mb-6 border border-green-300/30">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-400/20 text-red-100 px-4 py-3 rounded-lg mb-6 border border-red-300/30">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Full Name"
                    class="w-full bg-white/10 border border-white/20 rounded-xl py-3 pl-10 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/40 input-glow transition duration-300">
            </div>

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email Address"
                    class="w-full bg-white/10 border border-white/20 rounded-xl py-3 pl-10 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/40 input-glow transition duration-300">
            </div>

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <input type="password" name="password" required placeholder="Password"
                    class="w-full bg-white/10 border border-white/20 rounded-xl py-3 pl-10 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/40 input-glow transition duration-300">
            </div>

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-3.5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <input type="password" name="password_confirmation" required placeholder="Confirm Password"
                    class="w-full bg-white/10 border border-white/20 rounded-xl py-3 pl-10 pr-4 text-white placeholder-white/50 focus:outline-none focus:border-white/40 input-glow transition duration-300">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02]">
                Create Account
            </button>
        </form>

        <div class="text-center mt-6 text-white/80">
            Already have an account?
            <a href="{{ route('login') }}" class="text-white font-medium hover:underline hover:text-white/90 transition">Sign In</a>
        </div>
    </div>

    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('particles-js');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 6 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = `-${size}px`;
                particle.style.animationDuration = `${Math.random() * 10 + 10}s`;
                particle.style.animationDelay = `${Math.random() * 5}s`;
                container.appendChild(particle);
            }
        });
    </script>
</body>

</html>