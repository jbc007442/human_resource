@extends('dashboard.base')

@section('content')
<div class="max-w-5xl mx-auto p-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Test Questions</h1>
            <p class="text-slate-500 mt-1">Manage and review your assessment database.</p>
        </div>
        <div class="flex items-center gap-3">
            <span id="questionCount" class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-full text-sm font-bold border border-indigo-100">
                0 Questions
            </span>
            <button onclick="fetchQuestions()" class="p-2 hover:bg-slate-100 rounded-lg transition-colors text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>
    </div>

    <div id="questionsContainer" class="grid grid-cols-1 gap-6">
        <div class="animate-pulse space-y-4">
            <div class="h-32 bg-slate-200 rounded-2xl"></div>
            <div class="h-32 bg-slate-200 rounded-2xl"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => fetchQuestions());

    function fetchQuestions() {
        const container = document.getElementById('questionsContainer');
        
        fetch(`/test-questions/{{ $id }}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('questionCount').innerText = `${data.length} Questions`;
                
                if (data.length === 0) {
                    container.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 font-medium">No questions found in this set.</p>
                        </div>`;
                    return;
                }

                container.innerHTML = data.map((q, index) => `
                    <div class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <span class="flex-shrink-0 flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-slate-500 font-bold text-sm group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                ${index + 1}
                            </span>
                            <div class="flex-1">
                                <h2 class="text-lg font-semibold text-slate-800 leading-snug mb-4">
                                    ${q.question}
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                                    ${['a', 'b', 'c', 'd'].map(opt => `
                                        <div class="flex items-center p-3 rounded-xl border border-slate-100 bg-slate-50/50 text-slate-600 ${q.correct_answer.toLowerCase() === opt ? 'ring-2 ring-emerald-500 bg-emerald-50 border-emerald-100' : ''}">
                                            <span class="uppercase font-bold mr-3 text-slate-400 ${q.correct_answer.toLowerCase() === opt ? 'text-emerald-600' : ''}">${opt}.</span>
                                            ${q['option_' + opt]}
                                        </div>
                                    `).join('')}
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Answer Key</span>
                                    <span class="px-3 py-1 rounded-md bg-emerald-100 text-emerald-700 text-sm font-bold">
                                        Option ${q.correct_answer.toUpperCase()}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            })
            .catch(err => {
                container.innerHTML = `<div class="text-red-500 bg-red-50 p-4 rounded-xl">Error loading questions.</div>`;
            });
    }
</script>
@endsection