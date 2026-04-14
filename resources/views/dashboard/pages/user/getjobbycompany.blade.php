@extends('dashboard.base')

@section('content')
    <div class="min-h-screen bg-slate-50/50 py-12 px-6">
        <div class="max-w-7xl mx-auto">

            {{-- Breadcrumb & Back Button --}}
            <nav class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                <a href="{{ route('all.company') }}" class="hover:text-blue-600 transition">Companies</a>
                <span>/</span>
                <span class="text-slate-900 font-medium">Job Listings</span>
            </nav>

            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div class="flex items-center gap-5">
                    <div
                        class="h-16 w-16 bg-white rounded-2xl shadow-sm border border-slate-200 flex items-center justify-center text-xl font-bold text-blue-600">
                        {{ substr($company->company_name, 0, 1) }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                            {{ $company->company_name }}
                        </h1>
                        <p class="text-slate-500 mt-1 flex items-center gap-2">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500"></span>
                            {{ $jobs->count() }} Active Listings
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-semibold hover:bg-slate-50 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Export
                    </button>
                </div>
            </div>

            {{-- Table Container --}}
            <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Job Details
                                </th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Location
                                </th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Status</th>
                                <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">
                                    Applicants</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($jobs as $job)
                                <tr class="group hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-bold text-slate-900 text-base group-hover:text-blue-600 transition">{{ $job->title }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-1.5 text-slate-600">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $job->location ?? 'Remote' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-600 ring-1 ring-inset ring-emerald-600/10">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex justify-center">
                                            <a href="{{ route('applicants', $job->id) }}"
                                                class="group/btn flex items-center gap-2 px-4 py-1.5 rounded-xl border border-slate-200 bg-white text-slate-700 hover:border-blue-200 hover:bg-blue-50 transition shadow-sm">

                                                <span class="font-bold">{{ $job->applications_count }}</span>
                                                <span
                                                    class="text-xs text-slate-500 group-hover/btn:text-blue-600">Review</span>

                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center text-2xl mb-4">
                                                📂</div>
                                            <h3 class="text-slate-900 font-bold">No jobs posted yet</h3>
                                            <p class="text-slate-500 text-sm max-w-xs mt-1">Get started by creating your
                                                first job listing for this company.</p>
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
