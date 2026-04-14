@extends('dashboard.base')

@section('content')

<style>
    .luxury-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.7);
    }
    .luxury-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.04);
        border-color: rgba(99, 102, 241, 0.3);
    }
    .stat-label {
        letter-spacing: 0.1em;
        font-family: 'Instrument Sans', sans-serif;
    }
    .icon-box {
        position: relative;
        overflow: hidden;
    }
    .icon-box::after {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.1;
        background: currentColor;
    }
</style>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8 py-6">

    <div class="luxury-card p-10 rounded-[2rem] shadow-sm relative overflow-hidden">
        <div class="flex items-start justify-between mb-8">
            <div class="space-y-1">
                <span class="stat-label text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Academic Journey</span>
                <h3 class="text-slate-500 font-medium text-sm">Tests Attempted</h3>
            </div>
            <div class="icon-box w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-2">
            <span class="text-5xl font-semibold text-slate-900 tracking-tight">
                {{ $totalTests }}
            </span>
            <span class="text-slate-400 text-sm font-medium">completed</span>
        </div>
    </div>

    <div class="luxury-card p-10 rounded-[2rem] shadow-sm relative overflow-hidden">
        <div class="flex items-start justify-between mb-8">
            <div class="space-y-1">
                <span class="stat-label text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Performance Metric</span>
                <h3 class="text-slate-500 font-medium text-sm">Average Score</h3>
            </div>
            <div class="icon-box w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-1">
            <span class="text-5xl font-semibold text-slate-900 tracking-tight">
                {{ $avgScore }}
            </span>
            <span class="text-2xl font-light text-slate-300">%</span>
        </div>
    </div>

    <div class="luxury-card p-10 rounded-[2rem] shadow-sm relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-100/30 blur-3xl rounded-full"></div>
        
        <div class="flex items-start justify-between mb-8">
            <div class="space-y-1">
                <span class="stat-label text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Peak Achievement</span>
                <h3 class="text-slate-500 font-medium text-sm">Best Score</h3>
            </div>
            <div class="icon-box w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
        </div>
        <div class="flex items-baseline gap-1">
            <span class="text-5xl font-semibold text-slate-900 tracking-tight">
                {{ $bestScore }}
            </span>
            <span class="text-2xl font-light text-slate-300">%</span>
        </div>
    </div>

</div>
@endsection