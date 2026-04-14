@extends('dashboard.base')
@section('content')
    <form id="testForm" method="POST" action="{{ route('update.test', $test->id) }}">
        @csrf

        <div class="max-w-5xl mx-auto pb-20">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
                <div>
                    <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        <a href="#" class="hover:text-indigo-600 transition-colors">Assessments</a>
                        <i class="fas fa-chevron-right text-[8px]"></i>
                        <span class="text-slate-900">New Mock Test</span>
                    </nav>
                    <h1 class="text-3xl font-light text-slate-900 tracking-tight">Configure <span
                            class="font-semibold">Subjective
                            Test</span></h1>
                    <p class="text-slate-500 text-sm mt-2">Design open-ended questions to evaluate critical thinking and
                        depth of
                        knowledge.</p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button"
                        class="px-6 py-2.5 rounded-xl border border-slate-200 text-sm font-medium text-slate-600 hover:bg-slate-50 transition-all">
                        Save Draft
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-xl shadow-slate-200 hover:bg-slate-800 transition-all">
                        Publish Test
                    </button>
                </div>
            </div>

            <div class="bg-white border border-slate-100 rounded-3xl p-8 mb-10 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)]">

                <h2 class="text-lg font-semibold text-slate-800 mb-6">Test Configuration</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- TEST TITLE -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Test Title</label>
                        <input type="text" name="title" value="{{ $test->title }}"
                            class="w-full h-[42px] bg-slate-50 border border-slate-200 rounded-xl px-3 text-sm">
                    </div>

                    <!-- DURATION -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Duration (In min)</label>
                        <input type="number" name="duration" value="{{ $test->duration }}"
                            class="w-full h-[42px] bg-slate-50 border border-slate-200 rounded-xl px-3 text-sm">
                    </div>

                    <!-- TEST TYPE -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Test Type</label>
                        <select name="type"
                            class="w-full h-[42px] bg-white border border-slate-200 rounded-xl px-3 text-sm">

                            <option disabled>Select Type</option>
                            <option {{ $test->type == '🧪 Mock' ? 'selected' : '' }}>🧪 Mock</option>
                            <option {{ $test->type == '💼 Interview' ? 'selected' : '' }}>💼 Interview</option>
                            <option {{ $test->type == '🧠 Psychometric' ? 'selected' : '' }}>🧠 Psychometric</option>

                        </select>
                    </div>

                    <!-- LEVEL -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Difficulty</label>
                        <select name="level"
                            class="w-full h-[42px] bg-white border border-slate-200 rounded-xl px-3 text-sm">

                            <option disabled>Select Level</option>
                            <option {{ $test->level == '🟢 Basic' ? 'selected' : '' }}>🟢 Basic</option>
                            <option {{ $test->level == '🟡 Intermediate' ? 'selected' : '' }}>🟡 Intermediate</option>
                            <option {{ $test->level == '🔴 Advanced' ? 'selected' : '' }}>🔴 Advanced</option>

                        </select>
                    </div>

                    <!-- ICON -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 mb-2">Icon</label>

                        <div class="flex items-center gap-3">
                            <input type="text" name="icon" id="iconInput" value="{{ $test->icon }}"
                                class="w-full h-[42px] bg-slate-50 border border-slate-200 rounded-xl px-3 text-sm">

                            <div id="iconPreview"
                                class="w-10 h-10 flex items-center justify-center rounded-xl border bg-white">
                                <i class="{{ $test->icon ?? 'fa fa-question' }}"></i>
                            </div>
                        </div>
                    </div>

                    <!-- EMPTY -->
                    <div></div>

                </div>

                <!-- DESCRIPTION -->
                <div class="mt-6">
                    <label class="block text-xs font-semibold text-slate-500 mb-2">
                        Description
                    </label>
                    <textarea name="description" rows="4"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm 
            focus:outline-none focus:ring-2 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">{{ $test->description }}</textarea>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-12">

                <div class="space-y-8">

                    <div id="questions-container" class="space-y-6">

                        @foreach ($test->questions as $index => $q)
                            <div
                                class="question-block bg-white border border-slate-100 rounded-3xl p-8 shadow-[0_10px_40px_-15px_rgba(0,0,0,0.05)] relative group">

                                <!-- NUMBER -->
                                <div
                                    class="q-number absolute -left-3 top-8 w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center text-xs font-bold shadow-lg">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </div>

                                <!-- DELETE BUTTON -->
                                @if ($index > 0)
                                    <button type="button"
                                        class="delete-question absolute top-4 right-4 w-8 h-8 bg-red-50 text-red-500 rounded-lg">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                @endif

                                <div class="space-y-8">

                                    <!-- QUESTION -->
                                    <div>
                                        <label
                                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-3">
                                            Question Prompt
                                        </label>

                                        <textarea rows="3" name="questions[{{ $index }}][question]" required
                                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm">{{ $q->question }}</textarea>
                                    </div>

                                    <!-- OPTIONS -->
                                    <label class="text-xs font-semibold text-green-600 mb-2 block">
                                        Select Correct Answer
                                    </label>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                        @foreach (['a', 'b', 'c', 'd'] as $opt)
                                            <div class="flex items-center gap-2">

                                                <input type="radio" name="questions[{{ $index }}][correct_answer]"
                                                    value="{{ $opt }}"
                                                    {{ $q->correct_answer == $opt ? 'checked' : '' }} required>

                                                <input type="text"
                                                    name="questions[{{ $index }}][option_{{ $opt }}]"
                                                    value="{{ $q['option_' . $opt] }}"
                                                    placeholder="Option {{ strtoupper($opt) }}"
                                                    class="w-full bg-slate-50 border rounded-xl p-3">
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- ADD BUTTON -->
                    <button type="button" id="add-question"
                        class="w-full py-4 border-2 border-dashed border-slate-200 rounded-3xl text-slate-400 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50/30 transition-all group flex items-center justify-center gap-3">

                        <div
                            class="w-6 h-6 rounded-full border border-current flex items-center justify-center group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-[10px]"></i>
                        </div>

                        <span class="text-sm font-semibold">Add Subjective Question</span>

                    </button>

                </div>

            </div>
        </div>
    </form>


    <script>
        // ✅ IMPORTANT: dynamic count from backend
        let questionCount = {{ count($test->questions) }};

        $(function() {

            const form = $('#testForm');
            const container = $('#questions-container');
            const submitBtn = form.find('button[type="submit"]');

            // 🚀 SUBMIT (UPDATE)
            form.on('submit', function(e) {
                e.preventDefault();

                submitBtn.prop('disabled', true);

                Swal.fire({
                    title: 'Updating...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.post(form.attr('action'), form.serialize())
                    .done(() => {

                        Swal.fire({
                            icon: 'success',
                            title: 'Test Updated!'
                        });

                        // ❌ DO NOT RESET FORM IN UPDATE
                        // form[0].reset();

                    })
                    .fail((xhr) => {

                        if (xhr.status === 422) {
                            let msg = Object.values(xhr.responseJSON.errors)
                                .map(e => e[0]).join('<br>');

                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: msg
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong!'
                            });
                        }

                    })
                    .always(() => submitBtn.prop('disabled', false));
            });

            // ➕ ADD QUESTION
            $('#add-question').on('click', function() {

                const index = questionCount;
                questionCount++;

                const number = String(questionCount).padStart(2, '0');

                const block = $(getQuestionBlock(index, number)).appendTo(container);

                setTimeout(() => block.removeClass('opacity-0 translate-y-4'), 50);

                updateNumbers();
            });

            // ❌ DELETE QUESTION
            $(document).on('click', '.delete-question', function() {
                if ($('.question-block').length === 1) return;

                $(this).closest('.question-block').remove();

                updateNumbers();
            });

            // 🔢 UPDATE QUESTION NUMBERS
            function updateNumbers() {
                container.find('.question-block').each(function(i) {
                    $(this).find('.q-number').text(String(i + 1).padStart(2, '0'));
                });
            }

            // 🎯 ICON PREVIEW
            $('#iconInput').on('input', function() {
                let value = $(this).val().trim();
                $('#iconPreview').html(
                    value ? `<i class="${value}"></i>` : '<i class="fa fa-question"></i>'
                );
            });

        });

        // 🧱 QUESTION TEMPLATE (FOR ADD NEW)
        function getQuestionBlock(index, number) {
            return `
<div class="question-block bg-white border rounded-3xl p-8 shadow relative group opacity-0 translate-y-4 transition-all">

    <div class="q-number absolute -left-3 top-8 w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center text-xs font-bold">
        ${number}
    </div>

    <button type="button" class="delete-question absolute top-4 right-4 w-8 h-8 bg-red-50 text-red-500 rounded-lg">
        <i class="fas fa-trash text-xs"></i>
    </button>

    <div class="space-y-6">

        <!-- QUESTION -->
        <textarea name="questions[${index}][question]" rows="3"
            required
            placeholder="Enter your question..."
            class="w-full bg-slate-50 border rounded-xl p-3"></textarea>

        <!-- OPTIONS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

            ${['a','b','c','d'].map(o => `
                    <div class="flex items-center gap-2">

                        <input type="radio"
                            name="questions[${index}][correct_answer]"
                            value="${o}"
                            required>

                        <input type="text"
                            name="questions[${index}][option_${o}]"
                            placeholder="Option ${o.toUpperCase()}"
                            class="w-full bg-slate-50 border rounded-xl p-2">
                    </div>
                `).join('')}

        </div>

    </div>
</div>
`;
        }
    </script>
@endsection
