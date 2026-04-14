<div class="flex-1 px-4 flex justify-between">
    <div class="flex-1 flex items-center"></div>

    <div class="ml-4 flex items-center md:ml-6 gap-4">

        <!-- BUY PLAN BUTTON (ONLY JOBSEEKER) -->
        @if(Auth::user()->role === 'jobseeker')
            <a href="{{ route('payments.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow hover:bg-blue-700 transition">
                Buy Plan
            </a>
        @endif

        <!-- PROFILE DROPDOWN -->
        <div class="relative">
            <div id="profileBtn"
                class="flex items-center gap-3 pl-4 border-l border-slate-200 cursor-pointer select-none">

                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-900">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider">
                        {{ Auth::user()->role }}
                    </p>
                </div>

                <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-slate-100"
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff"
                    alt="">
            </div>

            <!-- DROPDOWN -->
            <div id="dropdownMenu"
                class="hidden absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden">

                <button id="logoutBtn"
                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-gray-100 transition">
                    Logout
                </button>

            </div>
        </div>

    </div>
</div>