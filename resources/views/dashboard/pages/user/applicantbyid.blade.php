@extends('dashboard.base')

@section('content')
    <div class="min-h-screen bg-slate-50/50 py-12 px-6">
        <div class="max-w-5xl mx-auto">

            {{-- Top Navigation & Header --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div class="flex items-center gap-4">
                    <a href="javascript:history.back()"
                        class="h-10 w-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $application->user->name }}</h1>
                        <p class="text-slate-500 font-medium">Applied for <span
                                class="text-blue-600">{{ $application->job->title }}</span></p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span
                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest bg-blue-50 text-blue-600 ring-1 ring-blue-200">
                        {{ $application->status }}
                    </span>
                </div>
            </div>

            {{-- Score Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                {{-- ATS Card --}}
                <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <div class="absolute top-0 right-0 p-4 opacity-10">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ATS Match Score</p>
                    <div class="flex items-baseline gap-1">
                        <h2 class="text-4xl font-black text-{{ $application->ats_color }}-600">
                            {{ $application->ats_score }}%</h2>
                    </div>
                    <p class="text-sm font-semibold text-slate-600 mt-1">{{ $application->ats_label }}</p>
                </div>

                {{-- Skill Test Card --}}
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Assessment Performance</p>
                    <h2 class="text-4xl font-black text-indigo-600">{{ $application->score_percentage }}%</h2>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                        <div class="bg-indigo-500 h-full" style="width: {{ $application->score_percentage }}%"></div>
                    </div>
                </div>

                {{-- Final Grade Card --}}
                <div class="bg-slate-900 p-6 rounded-[2rem] shadow-xl shadow-slate-200 text-white">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 text-opacity-80">Final
                        Calculated Score</p>
                    <h2 class="text-4xl font-black text-emerald-400">{{ $application->final_score }}%</h2>
                    <p class="text-xs text-slate-400 mt-2 font-medium italic">Weighted average of all stages</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Left Column: Details --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- AI Insight --}}
                    <div class="bg-blue-600 rounded-[2rem] p-8 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="p-1.5 bg-blue-400/30 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </span>
                                <h3 class="font-bold text-lg uppercase tracking-tight">AI Analysis & Feedback</h3>
                            </div>
                            <p class="text-blue-50 leading-relaxed italic text-lg text-serif">
                                "{{ $application->ats_feedback }}"
                            </p>
                        </div>
                        {{-- Decorative Circle --}}
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-500 rounded-full opacity-20"></div>
                    </div>

                    {{-- Assessment Answers --}}
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-8 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                            Technical Assessment
                            <span
                                class="text-xs font-normal text-slate-400 bg-slate-50 px-2 py-1 rounded-md">{{ count($application->answers) }}
                                Questions</span>
                        </h3>

                        <div class="space-y-6">
                            @forelse ($application->answers as $index => $ans)
                                <div
                                    class="group p-6 rounded-2xl border border-slate-100 hover:border-blue-100 hover:bg-blue-50/20 transition-all">
                                    <div class="flex justify-between items-start gap-4">
                                        <p class="font-bold text-slate-800 leading-snug">
                                            <span class="text-slate-300 mr-2">{{ $index + 1 }}.</span>
                                            {{ $ans->question }}
                                        </p>
                                        @if (!is_null($ans->is_correct))
                                            <span
                                                class="shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $ans->is_correct ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                                {{ $ans->is_correct ? 'Pass' : 'Fail' }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="mt-4 pl-6 border-l-2 border-slate-200 italic text-slate-600 text-sm">
                                        {{ $ans->answer }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 border-2 border-dashed border-slate-100 rounded-3xl">
                                    <p class="text-slate-400 font-medium">No assessment data available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right Column: Candidate Sidebar --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-[2rem] border border-slate-200 p-6 shadow-sm sticky top-6">
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Candidate Information
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Full
                                    Name</label>
                                <p class="text-slate-900 font-bold">{{ $application->user->name }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Email
                                    Address</label>
                                <p class="text-slate-900 font-bold truncate">{{ $application->user->email }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">Phone
                                    Number</label>
                                <p class="text-slate-900 font-bold">{{ $application->resume->phone ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-tighter">
                                    Education Background
                                </label>

                                @if ($application->resume->educations->count())
                                    @foreach ($application->resume->educations as $edu)
                                        <p class="text-slate-900 font-bold text-sm leading-relaxed">
                                            {{ $edu->degree }}
                                            @if ($edu->institute)
                                                - {{ $edu->institute }}
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-slate-400 text-sm">N/A</p>
                                @endif
                            </div>

                            <hr class="border-slate-100">

                            <button
                                class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-200 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                View Full Resume
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
