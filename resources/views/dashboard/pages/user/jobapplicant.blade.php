@extends('dashboard.base')

@section('content')
<div class="min-h-screen bg-slate-50/50 py-12 px-6">
    <div class="max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <div>
                <nav class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                    <a href="#" class="hover:text-blue-600 transition">Jobs</a>
                    <span>/</span>
                    <span class="text-slate-900 font-medium">Applicants</span>
                </nav>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                    {{ $job->title }}
                </h1>
                <p class="text-slate-500 mt-1 flex items-center gap-2">
                    <span class="font-semibold text-blue-600">{{ $applications->count() }}</span> Candidates applied for this position
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-50 transition shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Download CSV
                </button>
            </div>
        </div>

        {{-- Main Table Card --}}
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Candidate</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">ATS Match</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Skill Test</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">Final Score</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Profile</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($applications as $app)
                            <tr class="group hover:bg-blue-50/30 transition-colors">
                                
                                {{-- Candidate Info --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold text-sm">
                                            {{ strtoupper(substr($app->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900">{{ $app->user->name ?? 'Anonymous' }}</div>
                                            <div class="text-xs text-slate-500 font-medium">{{ $app->user->email ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- ATS Score --}}
                                <td class="px-6 py-5 text-center">
                                    <div class="inline-flex flex-col items-center">
                                        <span class="text-sm font-black text-{{ $app->ats_color }}-600">
                                            {{ $app->ats_score ?? 0 }}%
                                        </span>
                                        <span class="text-[10px] uppercase tracking-tighter font-bold text-slate-400">
                                            {{ $app->ats_label }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Test Score --}}
                                <td class="px-6 py-5">
                                    <div class="flex flex-col items-center gap-1.5">
                                        <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-indigo-500 h-full" style="width: {{ $app->score_percentage }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-indigo-700">{{ $app->score_percentage }}%</span>
                                    </div>
                                </td>

                                {{-- Final Score Badge --}}
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-block px-3 py-1 bg-green-50 text-green-700 rounded-lg font-extrabold text-sm ring-1 ring-green-200">
                                        {{ $app->final_score }}%
                                    </span>
                                </td>

                                {{-- Status Pill --}}
                                <td class="px-6 py-5">
                                    @php
                                        $statusClasses = [
                                            'shortlisted' => 'bg-emerald-100 text-emerald-700 ring-emerald-200',
                                            'rejected' => 'bg-rose-100 text-rose-700 ring-rose-200',
                                            'pending' => 'bg-amber-100 text-amber-700 ring-amber-200',
                                        ];
                                        $class = $statusClasses[$app->status] ?? 'bg-slate-100 text-slate-700 ring-slate-200';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-bold uppercase tracking-wide ring-1 ring-inset {{ $class }}">
                                        {{ $app->status }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('applicant.details', $app->id) }}"
                                       class="inline-flex items-center justify-center h-9 px-4 rounded-xl bg-white border border-slate-200 text-slate-700 text-xs font-bold hover:bg-blue-600 hover:text-white hover:border-blue-600 transition shadow-sm group/btn">
                                        Details
                                        <svg class="w-3.5 h-3.5 ml-1 transform group-hover/btn:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-3xl mb-4">👥</div>
                                        <h3 class="text-slate-900 font-bold text-lg">No applicants yet</h3>
                                        <p class="text-slate-500 text-sm max-w-xs mt-1">Share this job listing to start receiving applications from candidates.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection