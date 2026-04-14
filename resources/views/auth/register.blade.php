<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Portal | Register</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-6 py-12">

    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-5%] right-[-5%] w-[30%] h-[30%] bg-blue-600/10 blur-[100px] rounded-full"></div>
        <div class="absolute bottom-[-5%] left-[-5%] w-[30%] h-[30%] bg-indigo-600/10 blur-[100px] rounded-full"></div>
    </div>

    <div class="w-full max-w-2xl relative z-10">
        <div class="flex items-center justify-center gap-2 mb-10">
            <div class="bg-blue-600 p-2 rounded-xl text-white shadow-lg">
                <i class="fas fa-briefcase text-2xl"></i>
            </div>
            <span class="text-2xl font-extrabold tracking-tight text-slate-800 uppercase italic">Job<span
                    class="text-blue-600">Sync</span></span>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="text-center mb-10">
                    <h1 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h1>
                    <p class="text-slate-500 font-medium">Join thousands of professionals and companies today.</p>

                    <div id="formMessage" class="hidden mt-4 p-3 rounded-lg text-sm font-semibold"></div>
                </div>

                <form id="registerForm" action="{{ route('register.store') }}" method="POST"
                    class="space-y-6 max-w-4xl mx-auto bg-white p-8 rounded-3xl">
                    @csrf

                    <!-- Role -->
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 ml-1">
                            I am registering as
                        </label>

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-id-badge text-slate-400"></i>
                            </div>

                            <select id="role" name="role"
                                class="block w-full pl-11 pr-12 py-3.5 bg-slate-50 border-2 border-slate-100 rounded-2xl text-sm font-bold text-slate-700 appearance-none">
                                <option value="jobseeker">Jobseeker</option>
                                <option value="company">Company</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <p class="text-red-500 text-sm error-role"></p>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Name -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Full Name</label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="far fa-user"></i>
                                </span>

                                <input id="name" type="text" name="name" placeholder="John Doe"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                            </div>

                            <p class="text-red-500 text-sm error-name"></p>
                        </div>


                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Email Address</label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="far fa-envelope"></i>
                                </span>

                                <input id="email" type="email" name="email" placeholder="john@example.com"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                            </div>

                            <p class="text-red-500 text-sm error-email"></p>
                        </div>


                        <!-- Phone -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Phone Number</label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="fas fa-phone"></i>
                                </span>

                                <input id="phone" type="tel" name="phone" placeholder="9876543210"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                            </div>

                            <p class="text-red-500 text-sm error-phone"></p>
                        </div>


                        <!-- Password -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Password</label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input id="password" type="password" name="password" placeholder="••••••••"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                            </div>

                            <p class="text-red-500 text-sm error-password"></p>
                        </div>


                        <!-- Confirm Password -->
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700">Confirm Password</label>

                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i class="fas fa-shield-alt"></i>
                                </span>

                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="••••••••"
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm">
                            </div>

                            <p class="text-red-500 text-sm error-password_confirmation"></p>
                        </div>

                    </div>


                    <!-- Button -->
                    <button id="submitBtn" type="submit"
                        class="w-full bg-slate-900 hover:bg-blue-600 text-white font-semibold py-3.5 rounded-xl transition shadow-md">
                        Create Account
                    </button>

                </form>

                <p class="mt-10 text-center text-slate-500 text-sm font-medium">
                    Already have an account?
                    <a href="{{ url('/login') }}" class="text-blue-600 font-bold hover:underline">Sign In</a>
                </p>
            </div>
        </div>

        <div class="mt-8 flex justify-center gap-6">
            <a href="{{ url('/') }}"
                class="text-slate-400 hover:text-slate-600 text-xs font-bold uppercase tracking-widest flex items-center gap-2 transition-all">
                <i class="fas fa-home"></i> Home
            </a>
        </div>
    </div>


    <script src="{{ asset('js/jquery.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#registerForm').submit(function(e) {

                e.preventDefault();

                // Clear old errors
                $('[class^="error-"]').text('');
                $('#formMessage').addClass('hidden').text('');

                let formData = $(this).serialize();
                let button = $('#submitBtn');

                // Button loading state
                button.text('Creating Account...');
                button.prop('disabled', true);

                $.ajax({

                    url: "{{ route('register.store') }}",
                    type: "POST",
                    data: formData,

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {

                        button.text('Create Account');
                        button.prop('disabled', false);

                        // Show success message
                        $('#formMessage')
                            .removeClass('hidden bg-red-100 text-red-700')
                            .addClass('bg-green-100 text-green-700 p-3 rounded-lg mb-4')
                            .text(response.message);

                        // Redirect after 1 second
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000);

                    },

                    error: function(xhr) {

                        button.text('Create Account');
                        button.prop('disabled', false);

                        console.log(xhr); // see full error in browser console

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                $('.error-' + key).text(value[0]);
                            });

                        } else if (xhr.status === 500) {

                            $('#formMessage')
                                .removeClass('hidden')
                                .addClass('bg-red-100 text-red-700 p-3 rounded-lg')
                                .text('Server error (500). Please check Laravel logs.');

                        } else if (xhr.status === 419) {

                            $('#formMessage')
                                .removeClass('hidden')
                                .addClass('bg-red-100 text-red-700 p-3 rounded-lg')
                                .text('Session expired. Please refresh the page.');

                        } else {

                            $('#formMessage')
                                .removeClass('hidden')
                                .addClass('bg-red-100 text-red-700 p-3 rounded-lg')
                                .text(xhr.responseJSON?.message ?? 'Unknown error occurred.');

                        }

                    }

                });

            });

        });
    </script>

</body>

</html>
