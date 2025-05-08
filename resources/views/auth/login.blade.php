<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'School')</title>

    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body class="min-h-screen flex items-center justify-center font-sans overflow-hidden relative">
    <!-- خلفية متحركة من البقع الملونة -->
    <div class="fixed inset-0 overflow-hidden z-0">
        <div class="absolute top-10% left-20% w-40 h-40 bg-purple-500 rounded-full filter blur-3xl opacity-20 animate-float animation-delay-0"></div>
        <div class="absolute top-60% left-70% w-60 h-60 bg-blue-500 rounded-full filter blur-4xl opacity-20 animate-float animation-delay-2000"></div>
        <div class="absolute top-30% right-10% w-80 h-80 bg-pink-500 rounded-full filter blur-4xl opacity-15 animate-float animation-delay-4000"></div>
    </div>

    <!-- بطاقة تسجيل الدخول بتأثير الزجاج -->
    <div class="backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl p-10 w-full max-w-md z-10 shadow-2xl transition-all duration-500 transform hover:scale-[1.02] animate__animated animate__fadeIn">
        <!-- الشعار الدائري -->
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center border-2 border-white/30 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                </svg>
            </div>
        </div>

        <h2 class="text-4xl font-bold text-center text-white mb-8 tracking-wider">Welcome Back</h2>

        <!-- الرسائل الفلاش -->
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

        <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
            @csrf

            <!-- حقل الإيميل -->
            <div class="animate__animated animate__fadeInUp animate__faster">
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-4 bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition pl-12"
                        placeholder="Your Email">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- حقل كلمة المرور -->
            <div class="animate__animated animate__fadeInUp animate__faster animate__delay-100ms">
                <div class="relative">
                    <input type="password" name="password" required
                        class="w-full px-5 py-4 bg-white/5 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition pl-12"
                        placeholder="Your Password">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- تذكرني واستعادة كلمة المرور -->
            <div class="flex items-center justify-between text-sm animate__animated animate__fadeInUp animate__faster animate__delay-200ms">
                <label class="inline-flex items-center text-white/70">
                    <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-white bg-white/10 border-white/20 rounded focus:ring-white/30">
                    <span class="ml-2">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-white/70 hover:text-white transition-colors">Forgot password?</a>
            </div>

            <!-- زر تسجيل الدخول -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-purple-500/90 to-blue-500/90 hover:from-purple-600/90 hover:to-blue-600/90 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl backdrop-blur-md border border-white/20 animate__animated animate__fadeInUp animate__faster animate__delay-300ms">
                Sign In
                <span class="inline-block ml-2 transition-transform group-hover:translate-x-1">→</span>
            </button>
        </form>

        <!-- رابط التسجيل -->
        <div class="text-center text-sm text-white/70 mt-8 animate__animated animate__fadeInUp animate__faster animate__delay-400ms">
            <p>Don't have an account?
                <a href="{{ route('register.form') }}" class="text-white font-medium hover:text-white/90 transition-colors">Register here</a>
            </p>
        </div>
    </div>

    <!-- تأثيرات الحركة المخصصة -->
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(2deg);
            }
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        body {
            background: linear-gradient(135deg, #1a1b2f 0%, #2a2d45 100%);
        }
    </style>
</body>

</html>