@extends('dashboard.base')

@section('content')
    <div class="max-w-6xl mx-auto pb-20 px-4">
        <div class="mb-8">
            <a href="{{ route('dashboard.resume') }}"
                class="group inline-flex items-center text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-indigo-600 transition-colors">
                <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i> Back to
                Preview
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">

            <div class="lg:w-1/3">
                <div class="sticky top-8">
                    <h1 class="text-4xl font-light text-slate-900 tracking-tight leading-tight">
                        Refine Your <br> <span class="font-semibold text-indigo-600">Professional Identity</span>
                    </h1>
                    <p class="mt-6 text-slate-500 text-sm leading-relaxed">
                        This information will be used to generate your AI-optimized resume. Ensure your contact details are
                        up to date to help recruiters reach you faster.
                    </p>

                    <div class="mt-10 space-y-6">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0">
                                <i class="fas fa-check"></i>
                            </div>
                            <p class="text-[11px] font-medium text-slate-600 leading-normal">
                                <strong class="text-slate-900 block uppercase tracking-wider mb-1">ATS Optimization</strong>
                                Use keywords from your industry in the skills section to rank higher.
                            </p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs shrink-0">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <p class="text-[11px] font-medium text-slate-600 leading-normal">
                                <strong class="text-slate-900 block uppercase tracking-wider mb-1">Impactful
                                    Summary</strong>
                                Keep your summary under 3 sentences focusing on your top 2 achievements.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-2/3">
                <div class="bg-white border border-slate-100 shadow-[0_30px_70px_-20px_rgba(0,0,0,0.05)] p-8 md:p-12">
                    <form action="{{ route('resume.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-12">
                        @csrf


                        <div>
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-8 h-[1px] bg-slate-200"></span>
                                <h2 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Contact
                                    Information</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                                <!-- FULL NAME (READ ONLY) -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Full Name
                                    </label>

                                    <input type="text" value="{{ $user->name }}" readonly
                                        class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium outline-none cursor-not-allowed">
                                </div>

                                <!-- PROFESSIONAL TITLE -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Professional Title
                                    </label>

                                    <input type="text" name="title" value="{{ $resume->title ?? '' }}"
                                        placeholder="Full Stack Developer"
                                        class="w-full bg-slate-50/50 border border-slate-100 focus:border-indigo-500 focus:bg-white rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none">
                                </div>

                                <!-- EMAIL (READ ONLY) -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Email Address
                                    </label>

                                    <input type="email" value="{{ $user->email }}" readonly
                                        class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium outline-none cursor-not-allowed">
                                </div>

                                <!-- ADDRESS -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Address
                                    </label>

                                    <input type="text" name="address" value="{{ $resume->address ?? '' }}"
                                        placeholder="Chhattisgarh, India"
                                        class="w-full bg-slate-50/50 border border-slate-100 focus:border-indigo-500 focus:bg-white rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none">
                                </div>

                                <!-- PHONE (READ ONLY) -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Phone
                                    </label>

                                    <input type="text" value="{{ $user->phone ?? '' }}" readonly
                                        class="w-full bg-slate-100 border border-slate-200 rounded-2xl px-6 py-4 text-sm font-medium outline-none cursor-not-allowed">
                                </div>

                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-3 mb-8">
                                <span class="w-8 h-[1px] bg-slate-200"></span>
                                <h2 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Career
                                    Narrative</h2>
                            </div>

                            <div class="space-y-6">

                                <!-- SUMMARY -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Professional Summary
                                    </label>

                                    <textarea name="summary" rows="4" placeholder="Briefly describe your expertise and career goals..."
                                        class="w-full bg-slate-50/50 border border-slate-100 focus:border-indigo-500 focus:bg-white rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none resize-none">{{ $resume->summary ?? '' }}</textarea>
                                </div>

                                <!-- ACHIEVEMENTS -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                        Key Achievements
                                    </label>

                                    <textarea name="achievements" rows="3" placeholder="List your top 3 professional milestones..."
                                        class="w-full bg-slate-50/50 border border-slate-100 focus:border-indigo-500 focus:bg-white rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none resize-none">
                                         {{ old('achievements', $resume->achievements->pluck('title')->implode("\n")) }}
                                    </textarea>
                                </div>

                            </div>
                        </div>

                        <div class="space-y-10">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-[1px] bg-slate-200"></span>
                                    <h2 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">History &
                                        Expertise</h2>
                                </div>
                                <button type="button" id="add-experience-btn"
                                    class="text-[10px] font-black uppercase tracking-widest text-indigo-600 hover:text-slate-900 transition-colors flex items-center gap-2">
                                    <i class="fas fa-plus-circle"></i> Add Company
                                </button>
                            </div>

                            <div id="experience-container" class="space-y-10">

                                @if ($resume->experiences->count())
                                    @foreach ($resume->experiences as $i => $exp)
                                        <div
                                            class="experience-block bg-slate-50/30 border border-slate-100 p-8 rounded-[2rem] space-y-6 relative group">

                                            <!-- COMPANY + ROLE -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="space-y-2">
                                                    <label
                                                        class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                                        Company Name
                                                    </label>
                                                    <input type="text" name="company[]" value="{{ $exp->company_name }}"
                                                        placeholder="e.g. TechCorp Solutions"
                                                        class="w-full bg-white border border-slate-200 focus:border-indigo-500 rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none">
                                                </div>

                                                <div class="space-y-2">
                                                    <label
                                                        class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                                        Job Role
                                                    </label>
                                                    <input type="text" name="role[]" value="{{ $exp->job_title }}"
                                                        placeholder="e.g. Senior Developer"
                                                        class="w-full bg-white border border-slate-200 focus:border-indigo-500 rounded-2xl px-6 py-4 text-sm font-medium transition-all outline-none">
                                                </div>
                                            </div>

                                            <!-- YEARS -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="space-y-2">
                                                    <label class="text-[10px] font-black uppercase ml-1">From
                                                        (Year)
                                                    </label>
                                                    <input type="text" name="from_year[]"
                                                        value="{{ $exp->start_date }}"
                                                        class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">
                                                </div>

                                                <div class="space-y-2">
                                                    <label class="text-[10px] font-black uppercase ml-1">To (Year /
                                                        Present)</label>
                                                    <input type="text" name="to_year[]" value="{{ $exp->end_date }}"
                                                        class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">
                                                </div>
                                            </div>

                                            <!-- RESPONSIBILITIES -->
                                            <div class="space-y-3">
                                                <label
                                                    class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                                    Key Responsibilities
                                                </label>

                                                <div class="bullet-wrapper space-y-3">

                                                    @php
                                                        $responsibilities = !empty($exp->description)
                                                            ? explode(',', $exp->description)
                                                            : [''];
                                                    @endphp

                                                    @foreach ($responsibilities as $res)
                                                        <div class="bullet-row flex gap-3">
                                                            <div class="flex-1 relative">
                                                                <span
                                                                    class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs">•</span>
                                                                <input type="text"
                                                                    name="responsibilities[{{ $i }}][]"
                                                                    value="{{ trim($res) }}"
                                                                    placeholder="Describe responsibility..."
                                                                    class="w-full bg-white border border-slate-200 focus:border-indigo-500 rounded-xl pl-10 pr-6 py-3 text-xs font-medium outline-none">
                                                            </div>

                                                            <button type="button"
                                                                class="remove-bullet-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-300 hover:text-red-500 transition-all">
                                                                <i class="fas fa-times text-[10px]"></i>
                                                            </button>
                                                        </div>
                                                    @endforeach

                                                    <!-- ADD BUTTON -->
                                                    <button type="button"
                                                        class="add-bullet-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:text-indigo-600">
                                                        <i class="fas fa-plus text-[10px]"></i>
                                                    </button>

                                                </div>
                                            </div>

                                            <!-- REMOVE COMPANY -->
                                            <button type="button"
                                                class="remove-company-btn text-[9px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 pt-4">
                                                <i class="fas fa-trash-alt mr-2"></i> Remove Company
                                            </button>

                                        </div>
                                    @endforeach
                                @else
                                    <!-- DEFAULT EMPTY BLOCK -->
                                    <div
                                        class="experience-block bg-slate-50/30 border border-slate-100 p-8 rounded-[2rem] space-y-6 relative group">

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <input type="text" name="company[]" placeholder="Company Name"
                                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">

                                            <input type="text" name="role[]" placeholder="Job Role"
                                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">
                                        </div>

                                        <div class="grid grid-cols-2 gap-6">
                                            <input type="text" name="from_year[]" placeholder="From Year"
                                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">

                                            <input type="text" name="to_year[]" placeholder="To Year"
                                                class="w-full bg-white border border-slate-200 rounded-2xl px-6 py-4 text-sm">
                                        </div>

                                        <div class="bullet-wrapper space-y-3">
                                            <div class="bullet-row flex gap-3">
                                                <input type="text" name="responsibilities[0][]"
                                                    placeholder="Responsibility"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                                <button type="button" class="add-bullet-btn">+</button>
                                            </div>
                                        </div>

                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- ================= SKILLS ================= -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                    Skills
                                </label>

                                <div class="skills-wrapper space-y-3">

                                    @if ($resume->skills->count())
                                        @foreach ($resume->skills as $skill)
                                            <div class="skill-row flex gap-3">
                                                <input type="text" name="skills[]" value="{{ $skill->skill_name }}"
                                                    class="flex-1 bg-white border rounded-xl px-4 py-3 text-xs">

                                                <button type="button"
                                                    class="remove-skill-btn w-10 h-10 flex items-center justify-center rounded-xl border text-slate-300 hover:text-red-500">
                                                    <i class="fas fa-times text-[10px]"></i>
                                                </button>
                                            </div>
                                        @endforeach

                                        <!-- ADD BUTTON -->
                                        <div class="skill-row flex gap-3">
                                            <button type="button"
                                                class="add-skill-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:text-indigo-600">
                                                <i class="fas fa-plus text-[10px]"></i>
                                            </button>
                                        </div>
                                    @else
                                        <!-- DEFAULT EMPTY -->
                                        <div class="skill-row flex gap-3">
                                            <input type="text" name="skills[]" placeholder="e.g. Laravel"
                                                class="flex-1 bg-white border rounded-xl px-4 py-3 text-xs">

                                            <button type="button"
                                                class="add-skill-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-200 text-slate-400 hover:text-indigo-600">
                                                <i class="fas fa-plus text-[10px]"></i>
                                            </button>
                                        </div>
                                    @endif

                                </div>
                            </div>


                            <!-- ================= EDUCATION ================= -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                    Education
                                </label>

                                <div id="education-container" class="space-y-6">

                                    @if ($resume && $resume->educations->count())
                                        @foreach ($resume->educations as $edu)
                                            <div class="education-block border border-slate-200 rounded-2xl p-5 space-y-4">

                                                <input type="text" name="degree[]" value="{{ $edu->degree }}"
                                                    placeholder="Degree"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                                <div class="grid grid-cols-2 gap-3">
                                                    <input type="text" name="edu_from[]" value="{{ $edu->from }}"
                                                        placeholder="From Year"
                                                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                                    <input type="text" name="edu_to[]" value="{{ $edu->to }}"
                                                        placeholder="To Year"
                                                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">
                                                </div>

                                                <input type="text" name="institute[]" value="{{ $edu->institute }}"
                                                    placeholder="Institute Name"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                                <textarea name="edu_description[]" rows="3"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs resize-none">{{ $edu->description }}</textarea>

                                                <div class="flex gap-2">
                                                    <button type="button"
                                                        class="add-education-btn text-xs text-indigo-600 font-bold">
                                                        + Add
                                                    </button>

                                                    <button type="button"
                                                        class="remove-education-btn text-xs text-red-500 font-bold">
                                                        Remove
                                                    </button>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <!-- DEFAULT EMPTY -->
                                        <div class="education-block border border-slate-200 rounded-2xl p-5 space-y-4">

                                            <input type="text" name="degree[]" placeholder="Bachelor of Technology"
                                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                            <div class="grid grid-cols-2 gap-3">
                                                <input type="text" name="edu_from[]" placeholder="From Year"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                                <input type="text" name="edu_to[]" placeholder="To Year"
                                                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">
                                            </div>

                                            <input type="text" name="institute[]" placeholder="Institute Name"
                                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                                            <textarea name="edu_description[]" rows="3" placeholder="Description"
                                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs resize-none"></textarea>

                                            <div class="flex gap-2">
                                                <button type="button"
                                                    class="add-education-btn text-xs text-indigo-600 font-bold">
                                                    + Add
                                                </button>

                                                <button type="button"
                                                    class="remove-education-btn text-xs text-red-500 font-bold">
                                                    Remove
                                                </button>
                                            </div>

                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <!-- ================= RESUME UPLOAD (ADD HERE) ================= -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-900 uppercase tracking-widest ml-1">
                                Upload Resume (PDF)
                            </label>

                            <input type="file" name="resume_file" accept="application/pdf"
                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                            @if (!empty($resume->resume_file))
                                <a href="{{ asset('storage/' . $resume->resume_file) }}" target="_blank"
                                    class="text-xs text-indigo-600 underline mt-2 inline-block">
                                    View Current Resume
                                </a>
                            @endif
                        </div>

                        <div class="pt-6 border-t border-slate-50">
                            <button type="submit"
                                class="group w-full bg-slate-900 text-white font-bold py-6 shadow-xl shadow-slate-200 hover:bg-indigo-600 transition-all uppercase tracking-[0.2em] text-[10px] flex items-center justify-center gap-3">
                                Synchronize & Save Resume
                                <i
                                    class="fas fa-arrow-right text-[8px] group-hover:translate-x-2 transition-transform"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const container = document.getElementById('experience-container');
            const addExperienceBtn = document.getElementById('add-experience-btn');

            // ===============================
            // ADD NEW COMPANY BLOCK
            // ===============================
            addExperienceBtn.addEventListener('click', function() {
                const blocks = document.querySelectorAll('.experience-block');
                const blockCount = blocks.length;

                const newBlock = blocks[0].cloneNode(true);

                // Clear all inputs
                newBlock.querySelectorAll('input').forEach(input => {
                    input.value = '';
                });

                // Reset bullets (keep only first)
                const bulletWrapper = newBlock.querySelector('.bullet-wrapper');
                const bulletRows = bulletWrapper.querySelectorAll('.bullet-row');

                bulletRows.forEach((row, index) => {
                    if (index === 0) {
                        const input = row.querySelector('input');
                        if (input) {
                            input.name = `responsibilities[${blockCount}][]`;
                            input.value = '';
                        }
                    } else {
                        row.remove();
                    }
                });

                // Remove old delete button if exists
                const oldDeleteBtn = newBlock.querySelector('.remove-company-btn');
                if (oldDeleteBtn) oldDeleteBtn.remove();

                // Add delete company button
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className =
                    'remove-company-btn text-[9px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 transition-colors pt-4';
                deleteBtn.innerHTML = '<i class="fas fa-trash-alt mr-2"></i> Remove Company';

                deleteBtn.addEventListener('click', function() {
                    newBlock.remove();
                    reindexResponsibilities();
                });

                newBlock.appendChild(deleteBtn);
                container.appendChild(newBlock);
            });

            // ===============================
            // EVENT DELEGATION
            // ===============================
            document.addEventListener('click', function(e) {

                // ADD BULLET
                const addBulletBtn = e.target.closest('.add-bullet-btn');
                if (addBulletBtn) {
                    const wrapper = addBulletBtn.closest('.bullet-wrapper');
                    const companyBlock = addBulletBtn.closest('.experience-block');
                    const companyIndex = Array.from(document.querySelectorAll('.experience-block'))
                        .indexOf(companyBlock);

                    const newBullet = document.createElement('div');
                    newBullet.className = 'bullet-row flex gap-3 animate-fade-in';

                    newBullet.innerHTML = `
                <div class="flex-1 relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300 text-xs">•</span>
                    <input type="text"
                        name="responsibilities[${companyIndex}][]"
                        placeholder="Another responsibility..."
                        class="w-full bg-white border border-slate-200 focus:border-indigo-500 rounded-xl pl-10 pr-6 py-3 text-xs font-medium outline-none">
                </div>
                <button type="button"
                    class="remove-bullet-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-300 hover:text-red-500 transition-all">
                    <i class="fas fa-times text-[10px]"></i>
                </button>
            `;

                    wrapper.appendChild(newBullet);
                    return;
                }

                // REMOVE BULLET
                const removeBulletBtn = e.target.closest('.remove-bullet-btn');
                if (removeBulletBtn) {
                    const bulletRow = removeBulletBtn.closest('.bullet-row');
                    const wrapper = removeBulletBtn.closest('.bullet-wrapper');
                    const bullets = wrapper.querySelectorAll('.bullet-row');

                    if (bullets.length > 0) {
                        bulletRow.remove();
                    }
                    return;
                }
            });

            // ===============================
            // REINDEX RESPONSIBILITIES
            // ===============================
            function reindexResponsibilities() {
                document.querySelectorAll('.experience-block').forEach((block, blockIndex) => {
                    block.querySelectorAll('.bullet-row input').forEach(input => {
                        input.name = `responsibilities[${blockIndex}][]`;
                    });
                });
            }

            // ===============================
            // ADD SKILL
            // ===============================
            document.addEventListener('click', function(e) {
                const addSkillBtn = e.target.closest('.add-skill-btn');
                if (addSkillBtn) {
                    const wrapper = addSkillBtn.closest('.skills-wrapper');

                    const newRow = document.createElement('div');
                    newRow.className = 'skill-row flex gap-3';

                    newRow.innerHTML = `
            <input type="text" name="skills[]"
                placeholder="Another skill"
                class="flex-1 bg-white border border-slate-200 focus:border-indigo-500 rounded-xl px-4 py-3 text-xs font-medium outline-none">

            <button type="button"
                class="remove-skill-btn w-10 h-10 flex items-center justify-center rounded-xl border border-slate-100 text-slate-300 hover:text-red-500">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        `;

                    wrapper.appendChild(newRow);
                }

                // REMOVE SKILL
                const removeSkillBtn = e.target.closest('.remove-skill-btn');
                if (removeSkillBtn) {
                    const row = removeSkillBtn.closest('.skill-row');
                    const wrapper = removeSkillBtn.closest('.skills-wrapper');

                    if (wrapper.querySelectorAll('.skill-row').length > 1) {
                        row.remove();
                    }
                }
            });


            // ===============================
            // ADD EDUCATION
            // ===============================
            // ADD EDUCATION BLOCK
            document.addEventListener('click', function(e) {

                const addBtn = e.target.closest('.add-education-btn');
                if (addBtn) {

                    const container = document.getElementById('education-container');

                    const newBlock = document.createElement('div');
                    newBlock.className =
                        'education-block border border-slate-200 rounded-2xl p-5 space-y-4';

                    newBlock.innerHTML = `
            <input type="text" name="degree[]"
                placeholder="Degree"
                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="edu_from[]" placeholder="From Year"
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

                <input type="text" name="edu_to[]" placeholder="To Year"
                    class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">
            </div>

            <input type="text" name="institute[]"
                placeholder="Institute Name"
                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs">

            <textarea name="edu_description[]" rows="3"
                placeholder="Description"
                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs resize-none"></textarea>

            <div class="flex gap-2">
                <button type="button"
                    class="add-education-btn text-xs text-indigo-600 font-bold">
                    + Add
                </button>

                <button type="button"
                    class="remove-education-btn text-xs text-red-500 font-bold">
                    Remove
                </button>
            </div>
        `;

                    container.appendChild(newBlock);
                }

                // REMOVE EDUCATION
                const removeBtn = e.target.closest('.remove-education-btn');
                if (removeBtn) {
                    const blocks = document.querySelectorAll('.education-block');

                    if (blocks.length > 1) {
                        removeBtn.closest('.education-block').remove();
                    }
                }

            });

        });
    </script>
@endsection
