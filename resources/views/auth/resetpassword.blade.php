<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | Reset Password</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/jquery.js') }}"></script>
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-600/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/10 blur-[120px] rounded-full">
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
                    <div
                        class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Reset Password</h1>
                    <p class="text-slate-500 font-medium leading-relaxed">Almost there! Choose a strong password to
                        secure your account.</p>
                </div>

                <form action="#" class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">New Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-lock text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                            </div>
                            <input type="password" id="password" required placeholder="••••••••"
                                class="block w-full pl-11 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">

                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                                <i class="far fa-eye text-sm" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-slate-700 ml-1">Confirm New Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-check-double text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                            </div>
                            <input type="password" required placeholder="••••••••"
                                class="block w-full pl-11 pr-12 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-slate-900 text-sm focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all">
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Password must
                            contain:</p>
                        <ul class="grid grid-cols-2 gap-y-2">
                            <li class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                <i class="fas fa-circle text-[6px] text-blue-400"></i> 8+ Characters
                            </li>
                            <li class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                <i class="fas fa-circle text-[6px] text-slate-300"></i> One Uppercase
                            </li>
                            <li class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                <i class="fas fa-circle text-[6px] text-slate-300"></i> One Number
                            </li>
                            <li class="flex items-center gap-2 text-xs font-medium text-slate-500">
                                <i class="fas fa-circle text-[6px] text-slate-300"></i> One Special
                            </li>
                        </ul>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-200 hover:shadow-blue-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Update Password</span>
                        <i class="fas fa-check text-xs"></i>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-slate-400 text-sm">Remembered it? <a href="{{ url('/login') }}"
                            class="text-blue-600 font-bold hover:underline">Back to Sign In</a></p>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#togglePassword').on('click', function() {
                // Target the input and the icon
                const passwordInput = $('#password');
                const eyeIcon = $('#eyeIcon');

                // Toggle the type attribute
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);

                // Toggle the eye / eye-slash icon class
                eyeIcon.toggleClass('fa-eye fa-eye-slash');

                // Optional: Add a subtle color change when active
                $(this).toggleClass('text-blue-600 text-slate-400');
            });
        });
    </script>
</body>

</html>
