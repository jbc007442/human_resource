@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto pb-20 px-4">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-3xl font-light text-slate-900 tracking-tight">
                    Professional <span class="font-semibold">Resume</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Manage your professional identity and document generation.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.addresume') }}"
                    class="px-6 py-3 bg-slate-900 text-white text-xs font-bold uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
                    <i class="fas fa-edit mr-2"></i> Update Resume Details
                </a>

                <a href="{{ route('resume.download') }}"
                    class="px-6 py-3 bg-white border border-slate-200 text-xs font-bold text-slate-600 uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                    <i class="fas fa-file-pdf mr-2 text-indigo-500"></i> Download PDF
                </a>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-[#faf9f6] border border-slate-200 p-12 md:p-20 font-[Plus_Jakarta_Sans]">

                <!-- HEADER -->
                <div class="text-center mb-16">
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-wide text-slate-900 uppercase">
                        {{ $user->name }}
                    </h1>

                    <p class="mt-2 text-sm font-semibold text-slate-600 tracking-wide">
                        {{ $resume->title ?? 'Professional Title' }}
                    </p>

                    <p class="mt-4 text-xs text-slate-500 leading-relaxed">
                        {{ $user->email }} | {{ $user->phone ?? 'No Phone' }}<br>
                        {{ $resume->address ?? 'No Address' }}
                    </p>
                </div>

                <div class="space-y-16">

                    <!-- SUMMARY -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <h3 class="text-xs font-bold uppercase text-slate-900">Summary</h3>

                        <div class="md:col-span-3 border-l border-slate-300 pl-8">
                            <p class="text-sm text-slate-700">
                                {{ $resume->summary ?? 'No summary added yet.' }}
                            </p>
                        </div>
                    </div>

                    <!-- EXPERIENCE -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <h3 class="text-xs font-bold uppercase text-slate-900">Work Experience</h3>

                        <div class="md:col-span-3 border-l border-slate-300 pl-8 space-y-10">

                            @forelse ($resume->experiences as $exp)
                                <div>
                                    <!-- ROLE + DATE -->
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-bold text-slate-900">
                                            {{ $exp->job_title }}
                                        </h4>
                                        <span class="text-xs text-slate-500">
                                            {{ $exp->start_date ?? '—' }} – {{ $exp->end_date ?? 'Present' }}
                                        </span>
                                    </div>

                                    <!-- COMPANY -->
                                    <p class="text-xs font-semibold text-slate-600 mb-2">
                                        {{ $exp->company_name }}
                                    </p>

                                    <!-- RESPONSIBILITIES -->
                                    @if ($exp->description)
                                        @php
                                            $responsibilities = explode(',', $exp->description);
                                        @endphp

                                        <ul class="list-disc ml-5 text-sm text-slate-700 space-y-2">
                                            @foreach ($responsibilities as $res)
                                                @if (!empty(trim($res)))
                                                    <li>{{ trim($res) }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif

                                </div>
                            @empty
                                <p class="text-slate-400 text-sm">No experience added yet.</p>
                            @endforelse

                        </div>
                    </div>

                    <!-- EDUCATION -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <h3 class="text-xs font-bold uppercase text-slate-900">Education</h3>

                        <div class="md:col-span-3 border-l border-slate-300 pl-8 space-y-8">

                            @forelse ($resume->educations as $edu)
                                <div>
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-bold text-slate-900">
                                            {{ $edu->degree }}
                                        </h4>
                                        <span class="text-xs text-slate-500">
                                            {{ $edu->from ?? '—' }} – {{ $edu->to ?? 'Present' }}
                                        </span>
                                    </div>

                                    <p class="text-xs font-semibold text-slate-600">
                                        {{ $edu->institute }}
                                    </p>

                                    @if ($edu->description)
                                        <p class="text-sm text-slate-700 mt-1">
                                            {{ $edu->description }}
                                        </p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-slate-400 text-sm">No education added yet.</p>
                            @endforelse

                        </div>
                    </div>

                    <!-- SKILLS -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <h3 class="text-xs font-bold uppercase text-slate-900">Key Skills</h3>

                        <div class="md:col-span-3 border-l border-slate-300 pl-8">
                            <div class="grid grid-cols-2 gap-y-2 text-sm text-slate-700">

                                @forelse ($resume->skills as $skill)
                                    <span>• {{ $skill->skill_name }}</span>
                                @empty
                                    <p class="text-slate-400">No skills added yet.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>

                    <!-- ACHIEVEMENTS -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <h3 class="text-xs font-bold uppercase text-slate-900">Achievements</h3>

                        <div class="md:col-span-3 border-l border-slate-300 pl-8">
                            <ul class="list-disc ml-4 text-sm text-slate-700 space-y-2">

                                @forelse ($resume->achievements as $ach)
                                    <li>{{ $ach->title }}</li>
                                @empty
                                    <li class="text-slate-400">No achievements added yet.</li>
                                @endforelse

                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
