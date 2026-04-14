@extends('dashboard.base')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="max-w-5xl mx-auto py-10 px-4">

        <div class="flex items-center justify-between mb-8">
            <div>
                <nav class="flex text-sm text-slate-500 mb-2" aria-label="Breadcrumb">
                    <a href="#" class="hover:text-indigo-600">Jobs</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-800 font-medium">Applicants</span>
                </nav>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    <i class="fa-solid fa-users-rectangle text-indigo-500 mr-2"></i>
                    {{ $job->title }}
                </h2>
                <p class="text-slate-500 mt-1">Reviewing {{ $job->applications->count() }} total candidates</p>
            </div>

            <a href="#"
                class="hidden sm:block px-4 py-2 bg-white border border-slate-200 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-50 transition">
                <i class="fa-solid fa-download mr-2"></i>Export CSV
            </a>
        </div>

        <div class="space-y-6">
            @forelse($job->applications as $application)
                <div
                    class="group bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all duration-200 overflow-hidden">

                    <div class="p-6 sm:flex justify-between items-start bg-white">
                        <div class="flex items-center gap-4">
                            <div
                                class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-lg">
                                {{ strtoupper(substr($application->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-slate-900 group-hover:text-indigo-600 transition-colors">
                                    {{ $application->user->name }}
                                </h3>
                                <div class="flex items-center gap-3 text-sm text-slate-500 mt-1">
                                    <span><i
                                            class="fa-regular fa-envelope mr-1.5"></i>{{ $application->user->email }}</span>
                                    <span class="hidden sm:inline text-slate-300">•</span>
                                    <span><i class="fa-regular fa-calendar-check mr-1.5"></i>Applied
                                        {{ $application->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 sm:mt-0 flex flex-col items-end gap-2">

                            @php
                                $totalObjective = $application->answers->whereNotNull('is_correct')->count();
                                $correct = $application->answers->where('is_correct', true)->count();
                                $percentage = $totalObjective > 0 ? round(($correct / $totalObjective) * 100) : 0;
                            @endphp

                            @if ($totalObjective > 0)
                                <!-- SCORE -->
                                <div class="text-right">
                                    <p class="text-sm font-bold text-indigo-600">
                                        {{ $correct }} / {{ $totalObjective }}
                                    </p>
                                    <p class="text-xs text-slate-400">
                                        {{ $percentage }}% Score
                                    </p>
                                </div>

                                <!-- PROGRESS BAR 🔥 -->
                                <div class="w-32 h-2 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-600 rounded-full transition-all"
                                        style="width: {{ $percentage }}%"></div>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="px-6 pb-6">
                        <div class="border-t border-slate-50 pt-4">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center">
                                <i class="fa-solid fa-clipboard-question mr-2"></i> Questionnaire Responses
                            </h4>

                            @if ($application->answers->count())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($application->answers as $ans)
                                        <div
                                            class="relative bg-slate-50 p-4 rounded-xl border border-slate-100 transition-colors hover:bg-slate-100/50">

                                            <p class="text-xs font-bold text-slate-500 uppercase mb-1">Question</p>
                                            <p class="text-sm font-semibold text-slate-800 leading-relaxed mb-3">
                                                {{ $ans->question }}
                                            </p>

                                            <div class="flex items-start gap-2">
                                                <i class="fa-solid fa-reply text-slate-300 mt-1 rotate-180"></i>
                                                <p class="text-sm text-slate-600 italic">
                                                    "{{ $ans->answer }}"
                                                </p>
                                            </div>

                                            @if (!is_null($ans->is_correct))
                                                <div class="absolute top-4 right-4">
                                                    @if ($ans->is_correct)
                                                        <span
                                                            class="flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600 shadow-sm"
                                                            title="Correct">
                                                            <i class="fa-solid fa-check text-xs"></i>
                                                        </span>
                                                    @else
                                                        <span
                                                            class="flex items-center justify-center h-6 w-6 rounded-full bg-red-100 text-red-600 shadow-sm"
                                                            title="Incorrect">
                                                            <i class="fa-solid fa-xmark text-xs"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-slate-400 py-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <p class="text-sm italic">No answers were required for this application.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            @empty
                <div class="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-sm mb-4">
                        <i class="fa-solid fa-rocket text-2xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">No applicants yet</h3>
                    <p class="text-slate-500 max-w-xs mx-auto mt-2">When candidates apply for this position, they will
                        appear here in a list.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
