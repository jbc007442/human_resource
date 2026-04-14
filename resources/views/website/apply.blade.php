@extends('website.base')

@section('content')
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-4">

            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Review Your Application</h1>
                <p class="text-slate-600 mt-2">Check your details one last time before submitting to
                    <strong>{{ optional($job->company)->company_name }}</strong>.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 items-start">

                {{-- LEFT COLUMN: JOB SUMMARY (Sticky) --}}
                <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-8">
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm overflow-hidden relative">
                        {{-- Top Decorative Element --}}
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-50 rounded-full opacity-50"></div>

                        <div class="relative">
                            {{-- Company Header --}}
                            <div class="flex items-start gap-4 mb-6">
                                <div
                                    class="shrink-0 h-14 w-14 bg-gradient-to-br from-blue-600 to-indigo-700 text-white rounded-2xl flex items-center justify-center font-bold text-2xl shadow-lg shadow-blue-100">
                                    {{ substr(optional($job->company)->company_name ?? $job->title, 0, 1) }}
                                </div>
                                <div class="pt-1">
                                    <h2 class="text-xl font-extrabold text-slate-900 leading-tight tracking-tight">
                                        {{ $job->title }}
                                    </h2>
                                    <p class="text-sm font-semibold text-blue-600 flex items-center gap-1 mt-1">
                                        {{ optional($job->company)->company_name }}
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.64.304 1.24.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                            </path>
                                        </svg>
                                    </p>
                                </div>
                            </div>

                            {{-- Job Meta Badges --}}
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                    {{ $job->type ?? 'Full-time' }}
                                </span>
                            </div>

                            {{-- Detail List --}}
                            <div class="space-y-4 border-t border-slate-100 pt-6">
                                {{-- Location --}}
                                <div class="flex items-center group">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                                        <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-600" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p
                                            class="text-[10px] uppercase tracking-widest text-slate-400 font-bold leading-none mb-1">
                                            Location</p>
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ $job->location ?? 'Remote, India' }}</p>
                                    </div>
                                </div>

                                {{-- Salary with Rupee Symbol --}}
                                <div class="flex items-center group">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-emerald-50 transition-colors">
                                        <span class="text-lg font-bold text-slate-400 group-hover:text-emerald-600">₹</span>
                                    </div>
                                    <div class="ml-4">
                                        <p
                                            class="text-[10px] uppercase tracking-widest text-slate-400 font-bold leading-none mb-1">
                                            Annual CTC</p>
                                        <p class="text-sm font-bold text-slate-700">
                                            {{ $job->salary ? '₹' . $job->salary : 'Not Disclosed' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Short Description --}}
                            @if ($job->description)
                                <div class="mt-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-tighter mb-2">Role Brief
                                    </h4>
                                    <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $job->description }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div
                        class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-4 text-white shadow-lg shadow-blue-200">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-200 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-[11px] leading-snug font-medium text-blue-50">
                                Your full profile and contact details will be shared securely with the recruitment team.
                            </p>
                        </div>
                    </div>
                </div>


                {{-- RIGHT COLUMN: RESUME PREVIEW --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- ✅ PREMIUM STEP INDICATOR --}}
                    <div class="relative flex items-center justify-between mb-8 px-2">
                        <div class="absolute top-1/2 left-0 w-full h-0.5 bg-slate-200 -z-10 -translate-y-1/2"></div>

                        <div class="flex flex-col items-center gap-2 bg-slate-50 pr-4">
                            <span
                                class="flex items-center justify-center w-8 h-8 rounded-full font-bold text-xs transition-all duration-300 
                {{ $step == 1 ? 'bg-blue-600 text-white ring-4 ring-blue-100 shadow-lg' : 'bg-emerald-500 text-white' }}">
                                @if ($step > 1)
                                    ✓
                                @else
                                    1
                                @endif
                            </span>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest {{ $step == 1 ? 'text-blue-600' : 'text-slate-400' }}">Profile
                                Review</span>
                        </div>

                        @if ($job->has_test && $questions->count())
                            <div class="flex flex-col items-center gap-2 bg-slate-50 pl-4">
                                <span
                                    class="flex items-center justify-center w-8 h-8 rounded-full font-bold text-xs transition-all duration-300 
                    {{ $step == 2 ? 'bg-blue-600 text-white ring-4 ring-blue-100 shadow-lg' : 'bg-slate-300 text-slate-600' }}">
                                    2
                                </span>
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest {{ $step == 2 ? 'text-blue-600' : 'text-slate-400' }}">Skill
                                    Assessment</span>
                            </div>
                        @endif
                    </div>

                    {{-- SUCCESS ALERT --}}
                    @if (session('success'))
                        <div
                            class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl flex items-center shadow-sm text-sm animate-in fade-in slide-in-from-top-2">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- ================= STEP 1: COMPACT RESUME PREVIEW ================= --}}
                    @if ($step == 1 && $resume)
                        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden transition-all">
                            <div class="bg-slate-900 px-8 py-6 text-white flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-black tracking-tight">{{ $resume->full_name }}</h3>
                                    <p class="text-xs text-slate-400 font-medium mt-1">{{ $resume->email }} •
                                        {{ $resume->phone }}</p>
                                </div>
                                <div
                                    class="h-12 w-12 bg-white/10 rounded-xl flex items-center justify-center border border-white/10">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="p-8 space-y-6">
                                @if ($resume->summary)
                                    <p
                                        class="text-sm text-slate-500 leading-relaxed italic border-l-2 border-slate-100 pl-4">
                                        "{{ $resume->summary }}"</p>
                                @endif

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">
                                            Recent Experience</h4>
                                        <div class="space-y-3">
                                            @foreach ($resume->experiences->take(2) as $exp)
                                                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                                    <p class="font-bold text-xs text-slate-800">{{ $exp->job_title }}</p>
                                                    <p
                                                        class="text-[10px] text-blue-600 font-bold uppercase tracking-tighter">
                                                        {{ $exp->company_name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Top
                                            Expertise</h4>
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach ($resume->skills as $skill)
                                                <span
                                                    class="text-[10px] font-bold bg-white border border-slate-200 text-slate-600 px-2 py-1 rounded-lg">
                                                    {{ $skill->skill_name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 🤖 ATS MATCH RESULT --}}
                            @if ($alreadyApplied && isset($application) && !is_null($application->ats_score))
                                <div
                                    class="mt-6 p-5 rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50">

                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-sm font-black text-slate-800">ATS Match Score</h4>
                                        <span
                                            class="text-xs font-bold px-2 py-1 rounded-lg 
            bg-{{ $application->ats_color }}-100 
            text-{{ $application->ats_color }}-600">
                                            {{ $application->ats_label }}
                                        </span>
                                    </div>

                                    {{-- Progress Bar --}}
                                    <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                        <div class="h-3 rounded-full transition-all duration-500
            bg-{{ $application->ats_color }}-500"
                                            style="width: {{ $application->ats_score }}%">
                                        </div>
                                    </div>

                                    <p class="text-xs mt-2 font-bold text-slate-600">
                                        {{ $application->ats_score }}% Match
                                    </p>

                                    {{-- Breakdown --}}
                                    <div class="grid grid-cols-3 gap-3 mt-4 text-center text-[10px] font-bold">
                                        <div class="bg-white border border-slate-200 p-2 rounded-lg">
                                            Skills<br>
                                            <span class="text-blue-600">{{ $application->ats_skill_score }}%</span>
                                        </div>
                                        <div class="bg-white border border-slate-200 p-2 rounded-lg">
                                            Exp<br>
                                            <span class="text-indigo-600">{{ $application->ats_experience_score }}%</span>
                                        </div>
                                        <div class="bg-white border border-slate-200 p-2 rounded-lg">
                                            Edu<br>
                                            <span class="text-emerald-600">{{ $application->ats_education_score }}%</span>
                                        </div>
                                    </div>

                                    {{-- Feedback --}}
                                    @if ($application->ats_feedback)
                                        <p class="text-xs text-slate-500 mt-4 italic">
                                            "{{ $application->ats_feedback }}"
                                        </p>
                                    @endif

                                </div>
                            @endif

                            <div class="p-6 bg-slate-50 border-t border-slate-100">

                                {{-- ✅ ALREADY APPLIED --}}
                                @if ($alreadyApplied)

                                    <div
                                        class="w-full bg-gray-100 text-gray-500 py-4 rounded-2xl font-black text-sm text-center border border-gray-200">
                                        ✅ You have already applied for this job
                                    </div>
                                @else
                                    @if ($job->has_test && $questions->count())
                                        {{-- STRICT --}}
                                        @if ($job->test_mode === 'strict')
                                            <a href="{{ route('jobs.apply', [$job->id, 'step' => 2]) }}"
                                                class="group w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-sm flex items-center justify-center gap-3 hover:bg-blue-700 transition-all shadow-xl shadow-blue-100">
                                                Continue to Assessment
                                            </a>
                                        @endif

                                        {{-- FLEXIBLE --}}
                                        @if ($job->test_mode !== 'strict')
                                            <div class="flex flex-col sm:flex-row gap-3">

                                                <a href="{{ route('jobs.apply', [$job->id, 'step' => 2]) }}"
                                                    class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-black text-sm text-center hover:bg-indigo-700 transition-all">
                                                    Take the Test
                                                </a>

                                                <form method="POST" action="{{ route('jobs.apply.store', $job->id) }}"
                                                    class="flex-1">
                                                    @csrf
                                                    <input type="hidden" name="skip_test" value="1">

                                                    <button
                                                        class="w-full bg-white border border-slate-200 text-slate-600 py-4 rounded-2xl font-black text-sm hover:bg-slate-50 transition-all">
                                                        Skip & Apply Directly
                                                    </button>
                                                </form>

                                            </div>
                                        @endif
                                    @else
                                        {{-- NO TEST --}}
                                        <form method="POST" action="{{ route('jobs.apply.store', $job->id) }}">
                                            @csrf
                                            <button
                                                class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-sm hover:bg-blue-700 transition-all shadow-xl shadow-blue-100">
                                                Confirm & Submit Application
                                            </button>
                                        </form>
                                    @endif

                                @endif

                            </div>
                        </div>
                    @endif

                    {{-- ================= STEP 2: STYLISH ASSESSMENT ================= --}}
                    @if ($step == 2 && $questions->count())
                        <div
                            class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden animate-in fade-in zoom-in-95">
                            <div class="p-8 border-b border-slate-100 bg-slate-50/50">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="h-12 w-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.364-6.364l-.707-.707M6.364 17.636l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900">Skill Assessment</h3>
                                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Required by
                                            Hiring Manager</p>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('jobs.apply.store', $job->id) }}" class="p-8">
                                @csrf
                                <div class="space-y-10">
                                    @foreach ($questions as $index => $q)
                                        <div class="relative">
                                            <label class="block text-sm font-bold text-slate-800 mb-4 flex gap-3">
                                                <span class="text-blue-600">0{{ $index + 1 }}.</span>
                                                {{ $q->question }}
                                            </label>

                                            @if ($q->type === 'subjective')
                                                <textarea name="answers[{{ $index }}]" rows="4" placeholder="Type your answer here..."
                                                    class="w-full bg-slate-50 border border-slate-200 p-4 rounded-2xl text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none transition-all"
                                                    {{ $job->test_mode === 'strict' ? 'required' : '' }}></textarea>
                                            @elseif ($q->type === 'objective')
                                                <div class="grid grid-cols-1 gap-3">
                                                    @foreach ($q->options as $opt)
                                                        <label
                                                            class="flex items-center p-4 border border-slate-200 rounded-2xl cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all group">
                                                            <input type="radio" name="answers[{{ $index }}]"
                                                                value="{{ $opt->option_text }}"
                                                                class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-slate-300"
                                                                {{ $job->test_mode === 'strict' ? 'required' : '' }}>
                                                            <span
                                                                class="ml-3 text-sm font-semibold text-slate-600 group-hover:text-blue-700">{{ $opt->option_text }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-12 pt-8 border-t border-slate-100">
                                    @if ($alreadyApplied)
                                        <div
                                            class="w-full bg-gray-100 text-gray-500 py-4 rounded-2xl font-black text-lg text-center border">
                                            ✅ Application already submitted
                                        </div>
                                    @else
                                        <button
                                            class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-lg shadow-xl shadow-blue-100 hover:bg-blue-700 transition-all">
                                            Finalize & Submit
                                        </button>
                                    @endif
                                    <p
                                        class="text-center text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-4">
                                        Safe & Secure Submission</p>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>

                {{-- Add this to your CSS or a <style> tag for the shimmer animation --}}
                <style>
                    @keyframes shimmer {
                        100% {
                            transform: translateX(100%);
                        }
                    }
                </style>

            </div>
        </div>
    </div>
@endsection
