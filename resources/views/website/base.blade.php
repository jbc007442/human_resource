<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal | mocktest</title>

    <link href="{{ asset('css/font.css') }}" rel="stylesheet">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .job-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>


    <style>
        .nav-active-funky {
            background-color: #2563eb;
            /* Pure Blue */
            color: white !important;
            border-radius: 12px;
            padding: 8px 24px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            border: 2px solid #0f172a;
            /* Dark Slate Outline */

            /* The Funky 3D Shadow */
            box-shadow: 4px 4px 0px 0px #0f172a;

            /* Initial Lift */
            transform: translate(-2px, -2px);
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Hover effect to make it feel "bouncy" */
        .nav-active-funky:hover {
            transform: translate(-4px, -4px);
            box-shadow: 6px 6px 0px 0px #0f172a;
        }

        /* Click effect (The Button "Sinks" into the shadow) */
        .nav-active-funky:active {
            transform: translate(2px, 2px);
            box-shadow: 0px 0px 0px 0px #0f172a;
        }
    </style>

    <!-- 🔥 Page-level CSS -->
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900">

    @include('website.layouts.navbar')

    @yield('content')

    @include('website.layouts.footer')


   <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    
    <!-- 🔥 Page-level Scripts -->
    @stack('scripts')

</body>

</html>
