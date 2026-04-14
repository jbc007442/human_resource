@extends('website.base')
@section('content')
    <section class="bg-slate-900 py-12 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="text-left">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        Practice <span class="text-blue-500">Mock Tests</span>
                    </h1>
                    <p class="text-slate-400 text-sm">Prepare for technical and aptitude rounds.</p>
                </div>

                <div
                    class="glass-effect p-1.5 rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-1 w-full max-w-2xl">
                    <div class="flex items-center w-full px-3">
                        <i class="fas fa-book-open text-blue-500 text-sm mr-2"></i>
                        <input type="text" placeholder="Search topics (e.g. React, Logic)"
                            class="w-full py-2 bg-transparent focus:outline-none text-slate-900 text-sm placeholder:text-slate-500">
                    </div>
                    <button
                        class="w-full md:w-auto bg-blue-600 text-white px-8 py-2.5 rounded-lg font-semibold hover:bg-blue-500 transition-all text-sm whitespace-nowrap flex items-center justify-center gap-2">
                        <span>Explore Tests</span>
                        <i class="fas fa-chevron-right text-[10px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 py-20">
        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Mock Tests</h2>
                <p class="text-slate-500 mt-2">Choose a category to begin your assessment.</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    <i class="fas fa-th-large text-slate-600"></i>
                </button>
                <button class="p-3 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors">
                    <i class="fas fa-list text-slate-400"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($tests as $test)
                <div
                    class="group relative bg-white border border-slate-100 p-8 rounded-[2.5rem] 
                    hover:border-blue-500/20 hover:shadow-[0_20px_50px_rgba(8,112,184,0.07)] 
                    transition-all duration-500 ease-out flex flex-col justify-between overflow-hidden">

                    <div
                        class="absolute -top-24 -right-24 w-48 h-48 bg-blue-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                    </div>

                    <div>
                        <div class="flex justify-between items-start mb-10">
                            <div class="relative">
                                <div
                                    class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-900 
                                    group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-sm">
                                    <i class="{{ $test->icon ?? 'fas fa-book' }} text-2xl"></i>
                                </div>
                            </div>

                            <span
                                class="text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-[0.1em] border
                        @if ($test->level == 'beginner') border-emerald-100 bg-emerald-50 text-emerald-600
                        @elseif($test->level == 'intermediate') border-blue-100 bg-blue-50 text-blue-600
                        @else border-rose-100 bg-rose-50 text-rose-600 @endif">
                                {{ $test->level ?? 'Standard' }}
                            </span>
                        </div>

                        <h3
                            class="text-2xl font-semibold text-slate-900 mb-3 tracking-tight group-hover:text-blue-600 transition-colors">
                            {{ $test->title }}
                        </h3>

                        <p class="text-slate-500 text-sm mb-8 leading-relaxed line-clamp-2 font-light">
                            {{ $test->description }}
                        </p>

                        <div class="flex items-center gap-6 mb-10 border-y border-slate-50 py-4">
                            <div class="flex items-center gap-2.5">
                                <div class="p-1.5 bg-slate-50 rounded-lg group-hover:bg-white transition-colors">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700">{{ $test->duration ?? 0 }} min</span>
                            </div>

                            <div class="flex items-center gap-2.5">
                                <div class="p-1.5 bg-slate-50 rounded-lg group-hover:bg-white transition-colors">
                                    <svg class="w-4 h-4 text-slate-400 group-hover:text-blue-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="text-xs font-bold text-slate-700">{{ $test->questions_count }} Questions</span>
                            </div>
                        </div>
                    </div>

                    @php
                        $attemptedTests = auth()->user()->testAttempts->pluck('mock_test_id')->toArray();
                    @endphp

                    @if (in_array($test->id, $attemptedTests))
                        <!-- ❌ Already Attempted -->
                        <div
                            class="relative flex items-center justify-center gap-3 w-full py-4 px-6 bg-slate-200 text-slate-500 text-sm font-bold rounded-2xl cursor-not-allowed">

                            <span class="tracking-wide">Already Attempted</span>

                        </div>
                    @else
                        <!-- ✅ Start Test -->
                        <a href="{{ route('test.start', $test->id) }}"
                            class="relative flex items-center justify-center gap-3 w-full py-4 px-6 bg-slate-900 text-white text-sm font-bold rounded-2xl 
        overflow-hidden group hover:shadow-xl hover:shadow-blue-500/25 transition-all duration-300">

                            <span class="relative z-10 tracking-wide">Begin Assessment</span>

                            <svg class="w-4 h-4 relative z-10 group-hover:translate-x-1.5 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>

                            <div
                                class="absolute inset-0 bg-blue-600 translate-y-[102%] group-hover:translate-y-0 transition-transform duration-300 ease-out">
                            </div>
                        </a>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-slate-100 rounded-[2.5rem]">
                    <p class="text-slate-400 font-light italic">The curriculum is being updated. Check back soon.</p>
                </div>
            @endforelse

        </div>
    </main>
@endsection
