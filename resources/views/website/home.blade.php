@extends('website.base')
@section('content')
    <section class="bg-slate-900 py-12 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="text-left">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        Search <span class="text-blue-500">Opportunities</span>
                    </h1>
                    <p class="text-slate-400 text-sm">Find your next role at a world-class company.</p>
                </div>

                <div
                    class="glass-effect p-1.5 rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-1 w-full max-w-3xl">
                    <div class="flex items-center w-full px-3 border-r border-slate-700/50">
                        <i class="fas fa-search text-blue-500 text-sm mr-2"></i>
                        <input type="text" id="keyword" placeholder="Job title or company"
                            class="w-full py-2 bg-transparent focus:outline-none text-black text-sm placeholder:text-slate-500">
                    </div>
                    <div class="flex items-center w-full px-3">
                        <i class="fas fa-location-dot text-slate-500 text-sm mr-2"></i>
                        <input type="text" id="location" placeholder="Remote or City"
                            class="w-full py-2 bg-transparent focus:outline-none text-black text-sm placeholder:text-slate-500">
                    </div>
                    <button id="searchBtn"
                        class="w-full md:w-auto bg-blue-600 text-white px-8 py-2.5 rounded-lg font-semibold hover:bg-blue-500 transition-all text-sm">
                        Search
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto py-10 px-4">
        <div class="flex flex-col lg:flex-row gap-10">
            <aside class="w-full lg:w-72 shrink-0 space-y-5">

                <div class="flex items-center justify-between px-1">
                    <h3 class="font-bold text-slate-900 text-sm uppercase tracking-widest">Filters</h3>
                    <button class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Reset
                        All</button>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-3">Salary Range ($)</label>
                        <input type="range" min="30" max="250" value="100"
                            class="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-blue-600">
                        <div class="flex justify-between mt-2 text-[11px] font-bold text-slate-500">
                            <span>$30k</span>
                            <span class="text-blue-600 bg-blue-50 px-2 rounded">$100k+</span>
                            <span>$250k</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-900 uppercase mb-4">Specialization</h4>
                    <div class="space-y-3">
                        <label class="flex items-center justify-between group cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" checked
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/20">
                                <span
                                    class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Engineering</span>
                            </div>
                            <span
                                class="text-[10px] font-bold py-0.5 px-2 rounded-full bg-slate-50 text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">42</span>
                        </label>
                        <label class="flex items-center justify-between group cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="checkbox"
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/20">
                                <span
                                    class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Design</span>
                            </div>
                            <span
                                class="text-[10px] font-bold py-0.5 px-2 rounded-full bg-slate-50 text-slate-400">18</span>
                        </label>
                        <label class="flex items-center justify-between group cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="checkbox"
                                    class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500/20">
                                <span
                                    class="text-sm text-slate-600 group-hover:text-slate-900 transition-colors">Marketing</span>
                            </div>
                            <span class="text-[10px] font-bold py-0.5 px-2 rounded-full bg-slate-50 text-slate-400">7</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="text-xs font-bold text-slate-900 uppercase mb-4">Experience Level</h4>
                    <div class="grid grid-cols-1 gap-2">
                        <label
                            class="relative flex items-center justify-center py-2 px-3 border border-slate-100 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="exp" class="sr-only" checked>
                            <span class="text-xs font-semibold text-slate-600">Entry Level</span>
                        </label>
                        <label
                            class="relative flex items-center justify-center py-2 px-3 border border-slate-100 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="exp" class="sr-only">
                            <span class="text-xs font-semibold text-slate-600">Intermediate</span>
                        </label>
                        <label
                            class="relative flex items-center justify-center py-2 px-3 border border-slate-100 rounded-xl cursor-pointer hover:bg-slate-50 transition-all has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
                            <input type="radio" name="exp" class="sr-only">
                            <span class="text-xs font-semibold text-slate-600">Senior / Director</span>
                        </label>
                    </div>
                </div>

                <div class="bg-blue-600 p-5 rounded-2xl shadow-lg shadow-blue-200">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-bold text-blue-100 uppercase">Alerts</span>
                        <div class="w-8 h-4 bg-blue-400 rounded-full relative cursor-pointer shadow-inner">
                            <div class="absolute right-1 top-1 w-2 h-2 bg-white rounded-full"></div>
                        </div>
                    </div>
                    <p class="text-white text-xs font-medium leading-tight">Notify me of new jobs matching these
                        filters</p>
                </div>

            </aside>

            <div class="w-full">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">
                        Available Positions ({{ $jobs->total() }})
                    </h2>
                    <select class="bg-transparent text-sm font-semibold text-slate-700 outline-none cursor-pointer">
                        <option>Most Recent</option>
                        <option>Highest Salary</option>
                    </select>
                </div>

                <div id="jobResults" class="flex flex-col gap-6">
                    @forelse($jobs as $job)
                        <div
                            class="group relative bg-white border border-slate-200 rounded-2xl p-6 hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 cursor-pointer">

                            @if ($job->created_at->diffInDays() < 2)
                                <div
                                    class="absolute -top-3 left-6 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow-sm">
                                    New Posting
                                </div>
                            @endif

                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">

                                <div class="flex items-start gap-5">

                                    <div class="relative flex-shrink-0">
                                        <div
                                            class="w-16 h-16 rounded-xl overflow-hidden border-2 border-slate-100 bg-white flex items-center justify-center group-hover:border-blue-100 transition-colors">
                                            @if (optional($job->company)->logo)
                                                <img src="{{ asset('storage/' . $job->company->logo) }}"
                                                    class="w-full h-full object-contain p-1" alt="logo">
                                            @else
                                                <div class="bg-slate-50 w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-building text-slate-300 text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <div>
                                            <h3
                                                class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors inline-flex items-center gap-2">
                                                {{ $job->title }}
                                                <i
                                                    class="fas fa-external-link-alt text-xs opacity-0 group-hover:opacity-100 transition-opacity text-slate-400"></i>
                                            </h3>

                                            <div class="flex flex-wrap items-center gap-3 mt-1">
                                                <span class="text-sm font-bold text-slate-700">
                                                    {{ optional($job->company)->company_name ?? 'Unknown Company' }}
                                                </span>

                                                @if (optional($job->company)->website)
                                                    <a href="{{ $job->company->website }}" target="_blank"
                                                        rel="noopener noreferrer" onclick="event.stopPropagation();"
                                                        class="inline-flex items-center gap-1 text-xs font-medium text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-2 py-0.5 rounded transition-colors">
                                                        <i class="fas fa-globe"></i>
                                                        Website
                                                    </a>
                                                @endif

                                                <span class="hidden md:block text-slate-300">•</span>

                                                @if (optional($job->company)->industry)
                                                    <span
                                                        class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[11px] font-medium uppercase tracking-tight">
                                                        {{ $job->company->industry }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap items-center gap-y-2 gap-x-4">

                                            <span class="flex items-center text-sm text-slate-500">
                                                <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>
                                                {{ $job->location }}
                                            </span>

                                            @if ($job->salary)
                                                <span
                                                    class="flex items-center text-sm text-emerald-600 font-semibold bg-emerald-50 px-3 py-1 rounded-full">
                                                    <i class="fas fa-coins mr-2"></i>
                                                    {{ $job->salary }}
                                                </span>
                                            @endif

                                            @if (optional($job->company)->size)
                                                <span class="flex items-center text-sm text-slate-500">
                                                    <i class="fas fa-users mr-2 text-slate-400"></i>
                                                    {{ $job->company->size }}
                                                </span>
                                            @endif

                                            <!-- ✅ NEW: Applied Count -->
                                            <span class="flex items-center text-sm text-blue-600 font-medium">
                                                <i class="fas fa-user-check mr-2"></i>
                                                {{ $job->applications_count }} Applied
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center lg:flex-col lg:items-end justify-between border-t lg:border-t-0 pt-4 lg:pt-0 gap-4">

                                    <div class="flex items-center gap-3">

                                        @auth
                                            @if (auth()->user()->role === 'jobseeker')
                                                <!-- ✅ ALLOWED -->
                                                <a href="{{ route('jobs.apply', $job->id) }}"
                                                    class="bg-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition">
                                                    Apply Now
                                                </a>
                                            @else
                                                <!-- ❌ BLOCKED (admin/company) -->
                                                <button disabled
                                                    class="bg-gray-300 text-gray-500 px-8 py-2.5 rounded-xl text-sm font-bold cursor-not-allowed">
                                                    Not Allowed
                                                </button>
                                            @endif
                                        @else
                                            <!-- 🔐 NOT LOGGED IN -->
                                            <a href="{{ route('login') }}"
                                                class="bg-blue-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition">
                                                Login to Apply
                                            </a>

                                        @endauth

                                    </div>

                                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                                        <i class="far fa-clock"></i>
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                            <div
                                class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <i class="fas fa-search text-slate-300 text-xl"></i>
                            </div>
                            <h3 class="text-slate-900 font-bold">No jobs found</h3>
                            <p class="text-slate-500 text-sm mt-1">Try adjusting your filters or keywords.</p>
                        </div>
                    @endforelse
                </div>

                <!-- PAGINATION -->
                <div class="mt-6">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
