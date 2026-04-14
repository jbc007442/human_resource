<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | Forgot Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="w-full max-w-lg relative z-10">
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg shadow-blue-200">
                <i class="fas fa-briefcase text-2xl"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-slate-800 uppercase italic">Job<span class="text-blue-600">Sync</span></span>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                
                <div id="forgot-form-container">
                    <div class="text-center mb-10">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-key text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Forgot Password?</h1>
                        <p class="text-slate-500 font-medium leading-relaxed">No worries, it happens. Enter your email and we'll send you a reset link.</p>
                    </div>

                    <form action="#" class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-slate-700 ml-1">Email Address</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="far fa-envelope text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                                </div>
                                <input type="email" required placeholder="Enter your registered email" 
                                    class="block w-full pl-11 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Send Reset Link</span>
                            <i class="fas fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>

                <div id="success-state" class="hidden text-center py-4">
                    <div class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check-circle text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Check your email</h2>
                    <p class="text-slate-500 mb-8 leading-relaxed">We've sent a password reset link to <br><span class="font-bold text-slate-800">user@example.com</span></p>
                    <button onclick="location.reload()" class="text-blue-600 font-bold hover:underline">Resend email</button>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-100 text-center">
                    <a href="{{ url('/login') }}" class="text-slate-500 text-sm font-bold hover:text-blue-600 flex items-center justify-center gap-2 transition-colors">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>