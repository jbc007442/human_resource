@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto pb-20 px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-3xl font-light text-slate-900 tracking-tight">Applied <span class="font-semibold">Jobs</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1">Track your application status and profile match scores.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="/jobs"
                    class="px-5 py-3 bg-slate-900 text-white text-xs font-bold uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200 rounded-xl">
                    <i class="fas fa-search mr-2 text-[10px]"></i> Browse More Jobs
                </a>
            </div>
        </div>

        <div
            class="bg-white border border-slate-100 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.03)] overflow-hidden rounded-[2.5rem]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Job
                                Details</th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                ATS Score</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Applied
                                Date</th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status
                            </th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Manage</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">

                        @forelse($applications as $app)
                            <tr class="group hover:bg-slate-50/50 transition-all">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-5">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                                            <i class="fas fa-building text-lg"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">
                                                {{ $app->job->title }}
                                            </p>
                                            <p class="text-[11px] text-slate-400 font-bold uppercase">
                                                {{ $app->job->company->name ?? 'Company' }} •
                                                {{ $app->job->location ?? 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- ATS Score --}}
                                <td class="px-10 py-6 text-center">
                                    <span class="text-sm font-bold text-indigo-600">
                                        {{ $app->ats_score ?? '0' }}%
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-10 py-6">
                                    <p class="text-xs font-bold text-slate-600">
                                        {{ $app->created_at->format('M d, Y') }}
                                    </p>
                                </td>

                                {{-- Status --}}
                                <td class="px-10 py-6">
                                    <span
                                        class="px-4 py-1.5 text-[9px] font-black rounded-full uppercase
            @if ($app->status == 'approved') bg-green-50 text-green-600
            @elseif($app->status == 'rejected') bg-red-50 text-red-600
            @else bg-slate-100 text-slate-500 @endif">
                                        {{ ucfirst($app->status ?? 'pending') }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-10 py-6 text-center">
                                    <button class="px-4 py-2 bg-slate-900 text-white text-[9px] rounded-lg">
                                        View
                                    </button>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-slate-400">
                                    No applications found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
