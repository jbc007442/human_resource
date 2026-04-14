@extends('dashboard.base')

@section('content')
    <div class="min-h-screen bg-[#f8fafc] py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol
                            class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-semibold tracking-wide uppercase text-slate-400">
                            <li class="inline-flex items-center">Jobs</li>
                            <li><span class="mx-2">/</span></li>
                            <li class="text-indigo-600">Create New</li>
                        </ol>
                    </nav>
                    <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Post a Position</h1>
                    <p class="mt-2 text-slate-500 text-lg">Define the role and attract top-tier talent.</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-sm font-medium text-slate-600">Draft Auto-saved at 12:45 PM</span>
                </div>
            </div>

            <form action="{{ route('jobs.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/30">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="商務 21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Role Core Identity</h2>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-6 gap-6">
                        <div class="md:col-span-4">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Professional Job Title</label>
                            <input type="text" name="title" required
                                class="block w-full px-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all outline-none placeholder:text-slate-400"
                                placeholder="e.g. Senior Full Stack Engineer">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Employment Type</label>
                            <select name="type"
                                class="block w-full px-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                                <option value="full-time">Full Time</option>
                                <option value="part-time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Office Location</label>
                            <div class="relative">
                                <input type="text" name="location"
                                    class="block w-full px-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                                    placeholder="Bhopal, India / Remote">
                            </div>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-slate-700 mb-2">Department</label>
                            <input type="text" name="department"
                                class="block w-full px-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                                placeholder="Engineering / Design / Sales">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/30">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Compensation & Experience</h2>
                        </div>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Required Experience (Years)</label>
                            <div class="flex items-center p-1 bg-slate-100/50 rounded-2xl border border-slate-200">
                                <input type="number" name="experience_min" placeholder="Min"
                                    class="w-full bg-transparent px-4 py-2.5 outline-none text-slate-900 font-semibold text-center">
                                <div class="h-6 w-[2px] bg-slate-300"></div>
                                <input type="number" name="experience_max" placeholder="Max"
                                    class="w-full bg-transparent px-4 py-2.5 outline-none text-slate-900 font-semibold text-center">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-3">Expected Monthly Salary</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 font-bold">₹</span>
                                </div>
                                <input type="number" name="salary"
                                    class="block w-full pl-10 pr-4 py-3.5 bg-slate-50/50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                                    placeholder="85,000">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/30">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-amber-100 text-amber-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Job Narrative & Requirements</h2>
                        </div>
                    </div>

                    <div class="p-8 space-y-8">
                        <div>
                            <div class="flex justify-between mb-2">
                                <label class="text-sm font-bold text-slate-700">Detailed Description</label>
                                <span class="text-xs text-slate-400 font-medium italic">Supports Markdown</span>
                            </div>
                            <textarea name="description" rows="4"
                                class="block w-full px-4 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all resize-none"
                                placeholder="Describe the mission, culture, and day-to-day impact..."></textarea>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <label class="text-sm font-bold text-slate-700">Candidate Requirements</label>
                                <span class="text-xs text-slate-400 font-medium italic">List key skills &
                                    qualifications</span>
                            </div>
                            <textarea name="requirements" rows="4"
                                class="block w-full px-4 py-4 bg-slate-50/50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all resize-none"
                                placeholder="e.g. 3+ years of Laravel experience, Proficiency in Tailwind CSS..."></textarea>
                        </div>

                        <div
                            class="flex items-center justify-between p-6 bg-indigo-50/30 rounded-2xl border border-indigo-100/50">

                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Visibility Status</h4>
                                <p class="text-xs text-slate-500 mt-1">
                                    Make this job visible to candidates immediately.
                                </p>
                            </div>

                            <div class="flex items-center space-x-3">

                                <span id="status-label"
                                    class="text-xs font-bold uppercase tracking-wider text-indigo-600">
                                    Active
                                </span>

                                <label class="relative inline-flex items-center cursor-pointer">

                                    <!-- ✅ IMPORTANT (default value) -->
                                    <input type="hidden" name="status" value="inactive">

                                    <!-- ✅ actual toggle -->
                                    <input type="checkbox" name="status" value="active" class="sr-only peer"
                                        id="status-toggle" checked>

                                    <div
                                        class="w-12 h-6 bg-slate-300 rounded-full peer peer-checked:bg-indigo-600
                after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                after:bg-white after:border after:rounded-full after:h-5 after:w-5
                after:transition-all peer-checked:after:translate-x-full">
                                    </div>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="max-w-4xl mx-auto my-12 antialiased">
                    <div
                        class="bg-white rounded-[2.5rem] shadow-[0_20px_60px_-15px_rgba(15,23,42,0.1)] border border-slate-200/60 overflow-hidden">

                        <div class="px-10 py-8 bg-slate-50/50 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center space-x-5">
                                <div class="p-3.5 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900 tracking-tight">Assessment Suite</h2>
                                    <p class="text-sm font-medium text-slate-500">Configure entrance evaluations</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-10 space-y-10">
                            <div
                                class="flex items-center justify-between p-6 rounded-3xl bg-slate-50 border border-slate-100 transition-all">
                                <div class="space-y-1">
                                    <h4 class="text-base font-bold text-slate-800">Enable Mock Examination</h4>
                                    <p class="text-sm text-slate-500">Force candidates to complete a test before applying.
                                    </p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="has_test" value="1" id="has_test"
                                        class="sr-only peer">
                                    <div
                                        class="w-14 h-7 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                    </div>
                                </label>
                            </div>

                            <div id="test-options" class="hidden opacity-0 space-y-8 transition-all duration-500">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <!-- STRICT -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="test_mode" value="strict" class="sr-only peer">

                                        <div
                                            class="test-card p-5 rounded-2xl border-2 border-slate-100 bg-white 
            transition-all hover:border-indigo-200
            peer-checked:border-indigo-600 peer-checked:bg-indigo-50/30">

                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-bold text-slate-800">Strict Enforcement</h4>
                                                    <p class="text-xs text-slate-500 mt-1">Application locked until pass
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- FLEXIBLE -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="test_mode" value="flexible" checked
                                            class="sr-only peer">

                                        <div
                                            class="test-card p-5 rounded-2xl border-2 border-slate-100 bg-white 
            transition-all hover:border-indigo-200
            peer-checked:border-indigo-600 peer-checked:bg-indigo-50/30">

                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-bold text-slate-800">Flexible Entry</h4>
                                                    <p class="text-xs text-slate-500 mt-1">Candidates can skip the test</p>
                                                </div>
                                            </div>
                                        </div>
                                    </label>

                                </div>

                                <hr class="border-slate-100">

                                <div class="space-y-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-sm font-black uppercase tracking-widest text-slate-400">
                                                Question Builder</h3>
                                        </div>
                                        <div class="flex p-1 bg-slate-100 rounded-xl">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="question_type" value="subjective"
                                                    class="sr-only peer" checked>
                                                <span
                                                    class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm inline-block text-slate-500">Subjective</span>
                                            </label>
                                            <label class="cursor-pointer">
                                                <input type="radio" name="question_type" value="objective"
                                                    class="sr-only peer">
                                                <span
                                                    class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all peer-checked:bg-white peer-checked:text-indigo-600 peer-checked:shadow-sm inline-block text-slate-500">Objective</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div id="questions-container" class="space-y-4">
                                    </div>

                                    <button type="button" id="add-question"
                                        class="w-full py-4 border-2 border-dashed border-slate-200 rounded-2xl text-slate-500 font-bold text-sm hover:border-indigo-400 hover:text-indigo-600 hover:bg-indigo-50/30 transition-all flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Question
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="flex items-center justify-end space-x-4 pt-4">
                    <button type="button"
                        class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Discard
                        Draft</button>
                    <button type="submit"
                        class="px-10 py-4 bg-indigo-600 text-white text-sm font-bold rounded-2xl hover:bg-indigo-700 shadow-xl shadow-indigo-200 transition-all transform hover:-translate-y-1 active:scale-95">
                        Launch Job Posting
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const toggle = document.getElementById('has_test');
            const options = document.getElementById('test-options');
            const container = document.getElementById('questions-container');
            const addBtn = document.getElementById('add-question');

            let questionIndex = 0;

            // ✅ Show / Hide Test Section
            toggle.addEventListener('change', function() {
                if (this.checked) {
                    options.classList.remove('hidden');
                    setTimeout(() => options.classList.remove('opacity-0'), 10);
                } else {
                    options.classList.add('opacity-0');
                    setTimeout(() => options.classList.add('hidden'), 300);
                }
            });

            // ✅ Get selected question type
            function getType() {
                return document.querySelector('input[name="question_type"]:checked').value;
            }

            // ✅ Add Question
            addBtn.addEventListener('click', () => {

                const type = getType();

                const div = document.createElement('div');
                div.className =
                    "p-6 bg-white border border-slate-200 rounded-2xl shadow-sm relative group animate-in slide-in-from-top-2 duration-300";

                // ================= SUBJECTIVE =================
                if (type === 'subjective') {

                    div.innerHTML = `
                <div class="flex justify-between mb-4">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-500">
                        Subjective Question
                    </span>
                    <button type="button" class="remove text-slate-300 hover:text-red-500">
                        ✕
                    </button>
                </div>

                <textarea 
                    name="questions[${questionIndex}][question]" 
                    rows="3"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm outline-none"
                    placeholder="Type your question here..."
                ></textarea>

                <input type="hidden" name="questions[${questionIndex}][type]" value="subjective">
            `;

                } else {

                    // ================= OBJECTIVE =================

                    div.innerHTML = `
                <div class="flex justify-between mb-4">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-violet-500">
                        Objective (MCQ)
                    </span>
                    <button type="button" class="remove text-slate-300 hover:text-red-500">
                        ✕
                    </button>
                </div>

                <input 
                    type="text" 
                    name="questions[${questionIndex}][question]" 
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-sm font-bold mb-4 outline-none"
                    placeholder="Enter question prompt"
                >

                <input type="hidden" name="questions[${questionIndex}][type]" value="objective">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    ${[0,1,2,3].map(i => `
                            <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-xl border">
                                
                                <input 
                                    type="radio" 
                                    name="questions[${questionIndex}][correct]" 
                                    value="${i}"
                                    class="w-4 h-4 text-indigo-600"
                                >

                                <input 
                                    type="text" 
                                    name="questions[${questionIndex}][options][]" 
                                    class="bg-transparent w-full text-xs outline-none"
                                    placeholder="Option ${i+1}"
                                >
                            </div>
                        `).join('')}

                </div>
            `;
                }

                container.appendChild(div);
                questionIndex++;
            });

            // ✅ Remove Question
            container.addEventListener('click', (e) => {
                if (e.target.closest('.remove')) {
                    const el = e.target.closest('.group');
                    el.remove();
                }
            });

            // ✅ Reset when type changes
            document.querySelectorAll('input[name="question_type"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    container.innerHTML = '';
                    questionIndex = 0;
                });
            });

        });
    </script>
@endpush
