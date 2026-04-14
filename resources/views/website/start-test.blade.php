@extends('website.base')

@section('content')

<style>
    body { font-family: 'Inter', sans-serif; bg-slate-50; }
    .question-slide { display: none; }
    .question-slide.active { display: block; animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    /* Custom Radio Styling */
    input[type="radio"]:checked + .option-card {
        border-color: #3b82f6;
        background-color: #eff6ff;
        ring: 2px;
        ring-color: #3b82f6;
    }
</style>

<div id="loader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-slate-900 bg-opacity-90 transition-opacity duration-500 hidden">
    <div class="w-16 h-16 border-4 border-blue-400 border-t-transparent rounded-full animate-spin mb-4"></div>
    <p class="text-white font-medium animate-pulse">Submitting your responses...</p>
</div>

<div class="max-w-4xl mx-auto py-12 px-4">

    <div class="mb-10">
        <div class="flex justify-between items-end mb-4">
            <div>
                <span class="text-blue-600 font-bold text-sm uppercase tracking-wider">Examination Mode</span>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $test->title }}</h1>
            </div>
            <div class="text-right">
                <div class="text-xs font-bold text-slate-400 uppercase mb-1">Time Remaining</div>
                <div id="timer-container" class="bg-slate-900 text-white px-4 py-2 rounded-lg font-mono text-xl shadow-lg border border-slate-700">
                    <span id="timer">00:00</span>
                </div>
            </div>
        </div>
        
        <div class="w-full bg-slate-200 h-2 rounded-full overflow-hidden">
            <div id="progressBar" class="bg-blue-600 h-full transition-all duration-500" style="width: 0%"></div>
        </div>
        <div class="flex justify-between mt-2 text-xs font-bold text-slate-500">
            <span id="progressText">Question 1 of {{ $test->questions->count() }}</span>
            <span id="percentText">0% Complete</span>
        </div>
    </div>

    <form method="POST" action="{{ route('test.submit', $test->id) }}" id="testForm">
        @csrf
        <input type="hidden" id="timerInput" name="time_taken">

        <div class="relative min-h-[400px]">
            @foreach($test->questions as $index => $q)
                <div class="question-slide {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    <div class="bg-white border border-slate-200 rounded-3xl p-8 shadow-xl shadow-slate-200/50">
                        
                        <div class="flex items-center gap-3 mb-6">
                            <span class="flex items-center justify-center w-10 h-10 bg-blue-100 text-blue-700 rounded-full font-bold text-sm">
                                {{ $index + 1 }}
                            </span>
                            <h2 class="text-xl font-semibold text-slate-800 leading-snug">
                                {{ $q->question }}
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(['a','b','c','d'] as $opt)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" 
                                           name="answers[{{ $q->id }}]" 
                                           value="{{ $opt }}" 
                                           class="peer hidden"
                                           onchange="updateProgress()">
                                    <div class="option-card flex items-center p-4 rounded-2xl border-2 border-slate-100 bg-slate-50 transition-all group-hover:border-blue-200 group-hover:bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:shadow-md">
                                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-slate-200 mr-4 font-bold text-xs uppercase text-slate-400 peer-checked:bg-blue-500 peer-checked:text-white transition-colors">
                                            {{ $opt }}
                                        </span>
                                        <span class="text-slate-700 font-medium">{{ $q['option_'.$opt] }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
            <button type="button" id="prevBtn" onclick="changeQuestion(-1)" class="invisible flex items-center px-6 py-3 text-slate-600 font-bold hover:text-blue-600 transition">
                ← Previous
            </button>
            
            <div class="flex gap-4">
                <button type="button" id="nextBtn" onclick="changeQuestion(1)" class="bg-blue-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95">
                    Next Question
                </button>
                
                <button type="submit" id="submitBtn" class="hidden bg-emerald-600 text-white px-10 py-3 rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all active:scale-95">
                    Finish & Submit
                </button>
            </div>
        </div>
    </form>
</div>

<script>
let currentStep = 0;
const totalQuestions = {{ $test->questions->count() }};
let totalTime = {{ $test->duration * 60 }};
let timeLeft = totalTime;

const slides = document.querySelectorAll('.question-slide');
const progressBar = document.getElementById('progressBar');
const progressText = document.getElementById('progressText');
const percentText = document.getElementById('percentText');
const loader = document.getElementById('loader');

function changeQuestion(step) {
    slides[currentStep].classList.remove('active');
    currentStep += step;
    slides[currentStep].classList.add('active');

    // UI Updates
    document.getElementById('prevBtn').style.visibility = currentStep === 0 ? 'hidden' : 'visible';
    
    if (currentStep === totalQuestions - 1) {
        document.getElementById('nextBtn').classList.add('hidden');
        document.getElementById('submitBtn').classList.remove('hidden');
    } else {
        document.getElementById('nextBtn').classList.remove('hidden');
        document.getElementById('submitBtn').classList.add('hidden');
    }
    
    updateProgress();
}

function updateProgress() {
    const answeredCount = document.querySelectorAll('input[type="radio"]:checked').length;
    const percent = Math.round(((currentStep + 1) / totalQuestions) * 100);
    
    progressBar.style.width = percent + '%';
    progressText.innerText = `Question ${currentStep + 1} of ${totalQuestions}`;
    percentText.innerText = percent + '% Complete';
}

// Timer Logic
const timerEl = document.getElementById('timer');
const form = document.getElementById('testForm');
const timeInput = document.getElementById('timerInput');

function formatTime(seconds) {
    let m = Math.floor(seconds / 60);
    let s = seconds % 60;
    return `${m}:${s < 10 ? '0' : ''}${s}`;
}

const interval = setInterval(() => {
    timeLeft--;
    timerEl.innerText = formatTime(timeLeft);
    timeInput.value = totalTime - timeLeft;

    if (timeLeft <= 30) {
        document.getElementById('timer-container').classList.replace('bg-slate-900', 'bg-red-600');
    }

    if (timeLeft <= 0) {
        clearInterval(interval);
        handleSubmission();
    }
}, 1000);

// Form Submission with Loader
form.onsubmit = function() {
    handleSubmission();
    return true; 
};

function handleSubmission() {
    loader.classList.remove('hidden');
    loader.classList.add('flex');
}
</script>
@endsection