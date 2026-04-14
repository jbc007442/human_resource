@extends('website.base')

@section('content')

<div class="max-w-3xl mx-auto py-20 px-4">

    <!-- TITLE -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-slate-900">Your Test Result</h1>
        <p class="text-slate-500 mt-2">Here’s how you performed</p>
    </div>

    <!-- RESULT CARD -->
    <div class="bg-white rounded-3xl shadow-xl p-10 text-center border border-slate-100">

        <!-- SCORE -->
        <div class="mb-6">
            <h2 class="text-5xl font-black text-blue-600">
                {{ $attempt->score }}%
            </h2>
            <p class="text-sm text-slate-500 mt-2">Overall Score</p>
        </div>

        <!-- PROGRESS BAR -->
        <div class="w-full bg-slate-100 rounded-full h-3 mb-8 overflow-hidden">
            <div class="h-3 bg-blue-600 rounded-full transition-all duration-500"
                 style="width: {{ $attempt->score }}%">
            </div>
        </div>

        <!-- STATS -->
        <div class="grid grid-cols-3 gap-6 mb-8">

            <div>
                <p class="text-2xl font-bold text-slate-900">
                    {{ $attempt->correct_answers }}
                </p>
                <p class="text-xs text-slate-500">Correct</p>
            </div>

            <div>
                <p class="text-2xl font-bold text-slate-900">
                    {{ $attempt->total_questions }}
                </p>
                <p class="text-xs text-slate-500">Total</p>
            </div>

            <div>
                <p class="text-2xl font-bold text-slate-900">
                    {{ round($attempt->time_taken / 60, 2) }} min
                </p>
                <p class="text-xs text-slate-500">Time</p>
            </div>

        </div>

        <!-- PERFORMANCE BADGE -->
        @php
            $score = $attempt->score;
        @endphp

        <div class="mb-8">
            @if($score >= 80)
                <span class="px-4 py-2 bg-green-100 text-green-700 text-sm font-bold rounded-full">
                    Excellent 🚀
                </span>
            @elseif($score >= 50)
                <span class="px-4 py-2 bg-yellow-100 text-yellow-700 text-sm font-bold rounded-full">
                    Good 👍
                </span>
            @else
                <span class="px-4 py-2 bg-red-100 text-red-700 text-sm font-bold rounded-full">
                    Needs Improvement ⚠️
                </span>
            @endif
        </div>

        <!-- ACTION -->
        <a href="{{ route('mocktest') }}"
           class="inline-block bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-600 transition">
            Back to Tests
        </a>

    </div>

</div>

@endsection