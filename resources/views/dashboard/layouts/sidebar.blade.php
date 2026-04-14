<div class="flex flex-col flex-grow pt-8 pb-4 overflow-y-auto">
    <div class="flex items-center flex-shrink-0 px-6 mb-10">
        <div class="bg-slate-900 p-1.5 rounded-lg text-white mr-2.5 shadow-sm">
            <i class="fas fa-briefcase text-sm"></i>
        </div>
        <span class="text-lg font-bold tracking-tight text-slate-900">SS Consultancy</span>
    </div>

    <nav class="flex-1 px-4 space-y-1.5">
        @auth
            @if (auth()->user()->isAdmin())
                <div class="space-y-1 dropdown-container">

                    @php
                        $adminRoutes = ['dashboard', 'all-user', 'create-test', 'all user', 'leads', 'all-company', 'all-tests'];
                        $isAdminActive = Request::is($adminRoutes);
                    @endphp

                    <!-- DROPDOWN BUTTON -->
                    <button type="button"
                        class="dropdown-trigger w-full group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all
                {{ $isAdminActive ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                        <i class="fas fa-user-shield mr-3 text-sm"></i>
                        <span class="flex-1 text-left">Admin Panel</span>

                        <i
                            class="fas fa-chevron-right text-[10px] chevron transition-transform duration-300 
                {{ $isAdminActive ? 'rotate-90' : '' }}"></i>
                    </button>

                    <!-- DROPDOWN ITEMS -->
                    <div class="dropdown-list {{ $isAdminActive ? '' : 'hidden' }} pl-11 space-y-1">

                        <!-- Dashboard -->
                        <a href="{{ url('dashboard') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('dashboard') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Dashboard
                        </a>

                        <!-- All Users -->
                        <a href="{{ url('all-user') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('all-user') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            All Users
                        </a>

                        <!-- Create Test -->
                        <a href="{{ url('create-test') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('create-test') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Create Test
                        </a>

                        <!-- All Tests -->
                        <a href="{{ url('all-tests') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('all-tests') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            All Tests
                        </a>

                        <!-- Leads -->
                        <a href="{{ url('leads') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('leads') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Leads
                        </a>

                        <!-- All Companies -->
                        <a href="{{ url('all-company') }}"
                            class="block py-2 text-xs font-medium transition-colors
                    {{ Request::is('all-company') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            All Companies
                        </a>

                    </div>
                </div>
            @endif
        @endauth


        @auth
            @if (auth()->user()->isJobseeker())
                <div class="space-y-1 dropdown-container">
                    @php
                        $candidateRoutes = ['candidate-dashboard', 'applied-jobs', 'resume'];
                        $isCandidateActive = Request::is($candidateRoutes);
                    @endphp

                    <button type="button"
                        class="dropdown-trigger w-full group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all
        {{ $isCandidateActive ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                        <i class="fas fa-user mr-3 text-sm"></i>
                        <span class="flex-1 text-left">Candidate</span>

                        <i
                            class="fas fa-chevron-right text-[10px] chevron transition-transform duration-300 
        {{ $isCandidateActive ? 'rotate-90' : '' }}"></i>
                    </button>

                    <div class="dropdown-list {{ $isCandidateActive ? '' : 'hidden' }} pl-11 space-y-1">

                        <!-- Dashboard -->
                        <a href="{{ url('candidate-dashboard') }}"
                            class="block py-2 text-xs font-medium transition-colors 
            {{ Request::is('candidate-dashboard') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Candidate Dashboard
                        </a>

                        {{-- ✅ BOTH ADMIN + JOBSEEKER --}}
                        <a href="{{ url('applied-jobs') }}"
                            class="block py-2 text-xs font-medium transition-colors 
            {{ Request::is('applied-jobs') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Applied Jobs
                        </a>

                        <!-- Resume -->
                        <a href="{{ url('resume') }}"
                            class="block py-2 text-xs font-medium transition-colors 
            {{ Request::is('resume') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Resume
                        </a>

                    </div>
                </div>
            @endif
        @endauth

        @auth
            @if (auth()->user()->isCompany())
                <div class="space-y-1 dropdown-container">
                    @php
                        $companyRoutes = ['company-overview', 'job-list'];
                        $isCompanyActive = Request::is($companyRoutes);
                    @endphp

                    <button type="button"
                        class="dropdown-trigger w-full group flex items-center px-4 py-3 text-sm font-semibold rounded-xl transition-all
        {{ $isCompanyActive ? 'bg-slate-900 text-white shadow-lg shadow-slate-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fas fa-industry mr-3 text-sm"></i>
                        <span class="flex-1 text-left">Companies</span>
                        <i
                            class="fas fa-chevron-right text-[10px] chevron transition-transform duration-300 {{ $isCompanyActive ? 'rotate-90' : '' }}"></i>
                    </button>

                    <div class="dropdown-list {{ $isCompanyActive ? '' : 'hidden' }} pl-11 space-y-1">
                        <a href="{{ url('company-overview') }}"
                            class="block py-2 text-xs font-medium transition-colors
            {{ Request::is('overview') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Overview
                        </a>

                        <a href="{{ url('job-list') }}"
                            class="block py-2 text-xs font-medium transition-colors
            {{ Request::is('job-list') ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                            Job List
                        </a>
                    </div>
                </div>
            @endif
        @endauth

    </nav>
</div>
