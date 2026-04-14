<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JobSync | Dashboard</title>

    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/jquery.js') }}"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }


        /* Glassmorphism Effect */
        .luxury-toast {
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(209, 213, 219, 0.3);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* Progress Bar Animation */
        @keyframes shrink {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: currentColor;
            opacity: 0.3;
            animation: shrink 3000ms linear forwards;
        }

        /* Sophisticated Entrance */
        @keyframes luxuryIn {
            0% {
                transform: translateX(30px) scale(0.9);
                opacity: 0;
            }

            100% {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        .animate-luxury {
            animation: luxuryIn 0.6s cubic-bezier(0.22, 1, 0.36, 1);
        }
    </style>
</head>

<body class="h-full overflow-hidden">
    <div id="mobile-sidebar" class="fixed inset-0 z-50 md:hidden hidden" role="dialog" aria-modal="true">
        <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-y-0 left-0 flex w-full max-w-xs flex-col bg-white shadow-xl transition-transform duration-300 -translate-x-full"
            id="sidebar-panel">
            <div class="flex items-center justify-between px-6 h-20 border-b border-slate-100">
                <div class="flex items-center">
                    <div class="bg-blue-600 p-1.5 rounded-lg text-white mr-2">
                        <i class="fas fa-briefcase text-lg"></i>
                    </div>
                    <span class="text-xl font-black text-slate-800">JobSync</span>
                </div>
                <button id="close-sidebar" class="text-slate-500 hover:text-slate-800 p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto pt-4">
                @include('dashboard.layouts.sidebar')
            </div>
        </div>
    </div>

    <div class="flex h-screen bg-slate-50">
        <aside class="hidden md:flex md:w-72 md:flex-col md:fixed md:inset-y-0 border-r border-slate-200 bg-white">
            @include('dashboard.layouts.sidebar')
        </aside>

        <div class="md:pl-72 flex flex-col flex-1 w-0 overflow-hidden">
            <header class="relative z-10 flex-shrink-0 flex h-20 bg-white border-b border-slate-200">
                <button id="open-sidebar"
                    class="px-4 border-r border-slate-200 text-slate-500 md:hidden focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <i class="fas fa-bars-staggered text-xl"></i>
                </button>

                @include('dashboard.layouts.header')
            </header>

            <main class="flex-1 relative overflow-y-auto focus:outline-none bg-slate-50">
                <div class="py-8 px-4 sm:px-6 md:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // 1. Mobile Sidebar Toggle Logic
            function toggleSidebar(show) {
                if (show) {
                    $('#mobile-sidebar').removeClass('hidden');
                    setTimeout(() => {
                        $('#sidebar-panel').removeClass('-translate-x-full');
                    }, 10);
                } else {
                    $('#sidebar-panel').addClass('-translate-x-full');
                    setTimeout(() => {
                        $('#mobile-sidebar').addClass('hidden');
                    }, 300);
                }
            }

            $('#open-sidebar').on('click', function() {
                toggleSidebar(true);
            });

            $('#close-sidebar, #sidebar-backdrop').on('click', function() {
                toggleSidebar(false);
            });

            // 2. Dropdown Logic for Sidebar (Event Delegation)
            $(document).on('click', '.dropdown-trigger', function(e) {
                e.preventDefault(); // Prevent any accidental form submissions
                const container = $(this).closest('.dropdown-container');
                const list = container.find('.dropdown-list');
                const chevron = $(this).find('.chevron');

                // Toggle current dropdown
                list.toggleClass('hidden');
                chevron.toggleClass('rotate-90');

                // Accordion effect: Close other dropdowns
                $('.dropdown-list').not(list).addClass('hidden');
                $('.chevron').not(chevron).removeClass('rotate-90');
            });


        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const profileBtn = document.getElementById('profileBtn');
            const menu = document.getElementById('dropdownMenu');
            const logoutBtn = document.getElementById('logoutBtn');

            // 🔽 Toggle dropdown
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            // ❌ Close when clicking outside
            window.addEventListener('click', function(e) {
                if (!profileBtn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });

            // 🚀 AJAX LOGOUT
            logoutBtn.addEventListener('click', function() {

                logoutBtn.innerHTML = 'Logging out...';
                logoutBtn.disabled = true;

                fetch("{{ route('logout') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status) {
                            window.location.href = data.redirect;
                        }
                    })
                    .catch(() => {
                        logoutBtn.innerHTML = 'Logout';
                        logoutBtn.disabled = false;
                        alert('Logout failed. Try again.');
                    });

            });

        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        });
    </script>



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
function payNow(plan, amount) {

    console.log("Clicked:", plan, amount);
    console.log("Razorpay:", typeof Razorpay);

    if (typeof Razorpay === "undefined") {
        alert("Razorpay not loaded!");
        return;
    }

    var options = {
        key: "{{ env('RAZORPAY_KEY') }}",
        amount: amount * 100,
        currency: "INR",
        name: "JobSync",
        description: plan + " Plan",

        prefill: {
            name: "{{ auth()->user()->name }}",
            email: "{{ auth()->user()->email }}"
        },

        theme: {
            color: "#6366f1"
        },

        modal: {
            ondismiss: function () {
                console.log("Payment popup closed");
            }
        },

        handler: function (response) {
            console.log("Payment success:", response);

            let form = document.getElementById('payment-form-' + plan);

            form.querySelector('input[name="razorpay_payment_id"]').value =
                response.razorpay_payment_id;

            form.submit();
        }
    };

    try {
        var rzp = new Razorpay(options);
        rzp.open();
    } catch (e) {
        console.error("Razorpay error:", e);
        alert("Something went wrong opening payment");
    }
}
</script>

    @stack('scripts')

</body>

</html>
