<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b-2 border-slate-900">
    <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div
                class="bg-blue-600 p-2 rounded-lg text-white border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(15,23,42,1)]">
                <i class="fas fa-briefcase text-xl"></i>
            </div>
            <span class="text-xl font-black tracking-tight text-slate-900 uppercase">
                SS<span class="text-blue-600">Consultancy</span>
            </span>
        </div>

        <!-- Nav -->
        <nav class="hidden md:flex items-center gap-2">
            @php
                $linkClass = 'font-bold text-slate-600 hover:text-blue-600 px-3 py-1.5 transition-all';
            @endphp

            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'nav-active-funky' : $linkClass }}">
                Find Jobs
            </a>

            <a href="{{ url('/companies') }}" class="{{ Request::is('companies*') ? 'nav-active-funky' : $linkClass }}">
                Companies
            </a>

            @auth
                @if (auth()->user()->role === 'jobseeker')
                    <a href="{{ route('mocktest') }}"
                        class="{{ Request::is('mocktest*') ? 'nav-active-funky' : $linkClass }}">
                        Mock Test
                    </a>
                @endif
            @endauth

            <a href="{{ url('/about') }}" class="{{ Request::is('about*') ? 'nav-active-funky' : $linkClass }}">
                About
            </a>

            <a href="{{ url('/contact') }}" class="{{ Request::is('contact*') ? 'nav-active-funky' : $linkClass }}">
                Contact
            </a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="font-bold text-slate-900 hover:text-blue-600">
                    Sign In
                </a>
            @endguest

            @auth
                <a href="{{ auth()->user()->getRedirectRoute() }}" class="font-bold text-slate-900 hover:text-blue-600">
                    Dashboard
                </a>
            @endauth

            <a href="{{ auth()->check() ? auth()->user()->getRedirectRoute() : route('login') }}"
                class="bg-slate-900 text-white px-5 py-2 rounded-xl font-black border-2 border-slate-900
    shadow-[4px_4px_0px_0px_rgba(37,99,235,1)]
    hover:-translate-x-0.5 hover:-translate-y-0.5
    hover:shadow-[6px_6px_0px_0px_rgba(37,99,235,1)]
    active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                Post a Job
            </a>
        </div>

    </div>
</header>
