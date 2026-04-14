@extends('dashboard.base')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-200">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">User Management</h1>
            <p class="text-slate-500 text-sm">Profile Overview & Credentials</p>
        </div>
        <a href="{{ route('dashboard.alluser') }}" class="inline-flex items-center text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Return to User List
        </a>
    </div>

    <div class="space-y-6">
        
        <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
            <div class="p-8">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-slate-900 flex items-center justify-center rounded-lg text-white text-3xl font-bold shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h2 class="text-xl font-bold text-slate-900">{{ $user->name }}</h2>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest border {{ $user->is_active ? 'border-emerald-200 text-emerald-700 bg-emerald-50' : 'border-rose-200 text-rose-700 bg-rose-50' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p class="text-slate-500 font-medium text-sm capitalize">{{ $user->role }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12 mt-8 pt-8 border-t border-slate-100">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Email Address</label>
                        <p class="text-slate-900 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Phone Number</label>
                        <p class="text-slate-900 font-medium">{{ $user->phone ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- JOBSEEKER DESIGN --}}
        @if($user->role === 'jobseeker')
            @if(!empty($resume))
            <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                <div class="bg-slate-50 border-b border-slate-200 px-8 py-4">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-tight">Resume Information</h3>
                </div>
                <div class="p-8 space-y-10">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Professional Title</label>
                            <p class="text-slate-900 font-bold text-lg">{{ $resume->title ?? 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Core Competencies</label>
                            <div class="flex flex-wrap gap-2">
                                @forelse($resume->skills as $skill)
                                    <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded text-xs border border-slate-200">{{ $skill->name }}</span>
                                @empty
                                    <span class="text-slate-400 text-sm">None listed</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4">Professional Experience</label>
                        <div class="space-y-4">
                            @forelse($resume->experiences as $exp)
                                <div class="flex gap-4 p-4 border border-slate-100 rounded-lg">
                                    <div class="w-1 h-auto bg-slate-200 rounded"></div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">{{ $exp->position }}</h4>
                                        <p class="text-slate-500 text-sm">{{ $exp->company }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-slate-400 text-sm italic">No experience data found.</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-4">Education History</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($resume->educations as $edu)
                                <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                                    <p class="font-bold text-slate-900 text-sm">{{ $edu->degree }}</p>
                                    <p class="text-slate-500 text-xs">{{ $edu->institution }}</p>
                                </div>
                            @empty
                                <p class="text-slate-400 text-sm italic">No education data found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @endif

        {{-- COMPANY DESIGN --}}
        @elseif($user->role === 'company')
            @if(!empty($company))
            <div class="bg-white border border-slate-200 shadow-sm rounded-xl overflow-hidden">
                <div class="bg-slate-50 border-b border-slate-200 px-8 py-4 flex justify-between items-center">
                    <h3 class="text-sm font-bold text-slate-800 uppercase tracking-tight">Company Profile</h3>
                    <span class="text-[10px] font-mono text-slate-400">ID: {{ $company->id }}</span>
                </div>
                <div class="p-8 space-y-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="flex-1 space-y-6">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Entity Name</label>
                                <p class="text-xl font-black text-slate-900">{{ $company->name }}</p>
                            </div>
                            <div class="flex flex-wrap gap-x-12 gap-y-4">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Official Website</label>
                                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 font-medium text-sm hover:underline">{{ $company->website ?? 'Not Set' }}</a>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Headquarters</label>
                                    <p class="text-slate-900 text-sm font-medium">{{ $company->location ?? 'Not Set' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-slate-100">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">Company Bio</label>
                        <div class="bg-slate-50 p-6 rounded-lg text-slate-700 text-sm leading-relaxed">
                            {{ $company->about ?? 'No description provided.' }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif

    </div>
</div>
@endsection