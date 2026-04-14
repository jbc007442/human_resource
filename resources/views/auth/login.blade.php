<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full">
        </div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
                <i class="fas fa-briefcase text-2xl"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-slate-800 uppercase italic">Job<span
                    class="text-blue-600">Sync</span></span>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Welcome Back</h1>
                    <p class="text-slate-500 font-medium">Log in to your account to continue</p>
                </div>

                <form id="loginForm" class="space-y-6">
                    @csrf

                    <div class="space-y-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i
                                        class="far fa-envelope text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                                </div>
                                <input type="email" name="email" required placeholder="name@domain.com"
                                    class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-sm font-bold text-slate-700">Password</label>
                                <a href="{{ url('/forgot-password') }}"
                                    class="text-xs font-bold text-blue-600 hover:underline">Forgot Password?</a>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i
                                        class="fas fa-lock text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                                </div>
                                <input type="password" name="password" id="loginPassword" required
                                    placeholder="••••••••"
                                    class="block w-full pl-11 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">

                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                    <i class="far fa-eye text-sm" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer group w-fit">
                        <input type="checkbox" name="remember"
                            class="w-5 h-5 rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 transition-all">
                        <span class="text-sm font-medium text-slate-500 group-hover:text-slate-700">Keep me logged
                            in</span>
                    </label>

                    <!-- ✅ Error Message -->
                    <div id="loginError" class="hidden text-red-500 text-sm font-medium"></div>

                    <button type="submit" id="loginBtn"
                        class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-slate-100 text-center">
                    <p class="text-slate-500 text-sm font-medium">
                        New to JobSync?
                        <a href="{{ url('/register') }}" class="text-blue-600 font-bold hover:underline">Create an
                            account</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-6">
            <a href="{{ url('/') }}"
                class="text-slate-400 hover:text-slate-600 text-xs font-bold uppercase tracking-widest flex items-center gap-2 transition-all">
                <i class="fas fa-home"></i> Home
            </a>
        </div>
    </div>
    <script>
        const loginUrl = "{{ route('login.submit') }}";
        const csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/Auth/login.js') }}"></script>

</body>

</html>
