@extends('dashboard.base')

@section('content')
<div class="min-h-screen bg-slate-50/50 py-12 px-6">
    <div class="max-w-7xl mx-auto">

        {{-- Top Header & Search --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Partner Companies</h1>
                <p class="text-slate-500 mt-1">Directory of all registered organizations and their listing counts.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </span>
                    <input type="text" placeholder="Search companies..." class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition outline-none w-64 shadow-sm">
                </div>
                <button class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                </button>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-[2rem] border border-slate-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 w-20">#</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Company Name</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Website</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500">Open Roles</th>
                            <th class="px-6 py-5 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($companies as $index => $company)
                            <tr class="group hover:bg-blue-50/30 transition-colors">
                                <td class="px-6 py-5 text-slate-400 font-medium text-sm">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        @if ($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}"
                                                 class="h-12 w-12 rounded-xl object-cover border border-slate-200 shadow-sm">
                                        @else
                                            <div class="h-12 w-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center text-slate-500 font-bold border border-slate-200">
                                                {{ substr($company->company_name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $company->company_name }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    @if ($company->website)
                                        <a href="{{ $company->website }}" target="_blank" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold hover:bg-blue-100 hover:text-blue-600 transition">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                            Visit Site
                                        </a>
                                    @else
                                        <span class="text-slate-300 text-xs">No Website</span>
                                    @endif
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-xs font-extrabold ring-1 ring-indigo-200">
                                            {{ $company->jobs_count }} Jobs
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('get.job.by.company', ['company_id' => $company->id]) }}" 
                                       class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition group/link">
                                        View Jobs
                                        <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <span class="text-4xl mb-4">🏢</span>
                                        <h3 class="text-slate-900 font-bold text-lg">No companies found</h3>
                                        <p class="text-slate-500 text-sm max-w-xs mt-1">Try adjusting your search or add a new company to the directory.</p>
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