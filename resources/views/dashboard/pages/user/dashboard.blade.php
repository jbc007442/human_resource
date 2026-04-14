@extends('dashboard.base')

@section('content')
<div class="max-w-6xl mx-auto px-4 space-y-8 pb-12">
    
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-100 pb-6">
        <div>
            <nav class="flex mb-2 text-[10px] uppercase tracking-[0.2em] font-bold text-indigo-500">
                Administration / Overview
            </nav>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">System Analytics</h1>
            <p class="text-slate-400 text-xs mt-1 font-medium">Real-time breakdown of your platform ecosystem.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="relative group overflow-hidden bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Users</p>
                    <h3 class="text-3xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors tracking-tighter">
                        {{ number_format($totalUsers) }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-all duration-500">
                    <i class="fas fa-users text-sm"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="flex items-center gap-1 text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-full">
                    <i class="fas fa-chart-line"></i> Active
                </span>
                <span class="text-[10px] text-slate-400 font-medium italic">System wide</span>
            </div>
        </div>

        <div class="relative group overflow-hidden bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Partnerships</p>
                    <h3 class="text-3xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors tracking-tighter">
                        {{ number_format($totalCompanies) }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-all duration-500">
                    <i class="fas fa-building text-sm"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="flex items-center gap-1 text-[10px] font-bold text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-full">
                    <i class="fas fa-briefcase"></i> Hiring
                </span>
                <span class="text-[10px] text-slate-400 font-medium italic">Corporate accounts</span>
            </div>
        </div>

        <div class="relative group overflow-hidden bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-500">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Talent Pool</p>
                    <h3 class="text-3xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors tracking-tighter">
                        {{ number_format($totalJobseekers) }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-all duration-500">
                    <i class="fas fa-user-graduate text-sm"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="flex items-center gap-1 text-[10px] font-bold text-amber-500 bg-amber-50 px-2 py-0.5 rounded-full">
                    <i class="fas fa-search"></i> Browsing
                </span>
                <span class="text-[10px] text-slate-400 font-medium italic">Verified seekers</span>
            </div>
        </div>

    </div>
</div>

<style>
    /* Custom Luxury Shadow for the "Active" feel */
    .shadow-sm {
        box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    }
    
    /* Elegant Font Smoothing */
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        background-color: #fcfcfd; /* Slightly warmer white for luxury feel */
    }
</style>
@endsection