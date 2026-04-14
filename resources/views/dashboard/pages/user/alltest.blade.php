@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto pb-20 px-4">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-3xl font-light text-slate-900 tracking-tight">
                    Mock <span class="font-semibold">Tests</span>
                </h1>
                <p class="text-slate-500 text-sm mt-1">
                    Manage and access all available tests.
                </p>
            </div>

            <button
                class="px-5 py-3 bg-slate-900 text-white text-xs font-bold uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200 rounded-xl">
                <i class="fas fa-plus mr-2 text-[10px]"></i> Create Test
            </button>
        </div>

        <!-- TABLE -->
        <div
            class="bg-white border border-slate-100 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.03)] overflow-hidden rounded-[2.5rem]">

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">

                    <!-- HEAD -->
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Test Details
                            </th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Duration
                            </th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Questions
                            </th>
                            <th class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                Level
                            </th>
                            <th
                                class="px-10 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <!-- BODY -->
                    <tbody id="testTableBody" class="divide-y divide-slate-50">
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-400">
                                Loading tests...
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // View Test Button Logic
        function viewTest(id) {
            window.location.href = "{{ url('/test-questions-page') }}/" + id;
        }
        // Edit Test Button Logic
        function editTest(id) {
            window.location.href = `/edit-test/${id}`;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            fetchTests();

            function fetchTests() {
                fetch("/tests-json")
                    .then(res => res.json())
                    .then(tests => {

                        let html = '';

                        if (tests.length === 0) {
                            html = `
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-400">
                            No tests found
                        </td>
                    </tr>`;
                        } else {

                            tests.forEach(test => {

                                let badge = `
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-[9px] font-black rounded-full uppercase tracking-widest border border-green-100">
                            ${test.level ?? 'Free'}
                        </span>`;

                                html += `
<tr class="group hover:bg-slate-50/50 transition-all">

    <!-- TEST INFO -->
    <td class="px-10 py-6">
        <div class="flex items-center gap-4">

            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm shadow-sm">
                <i class="${test.icon ?? 'fas fa-book'}"></i>
            </div>

            <div>
                <p class="text-sm font-bold text-slate-900">
                    ${test.title}
                </p>
                <p class="text-[11px] text-slate-400 font-medium tracking-tight">
                    ${test.description ?? 'No description'}
                </p>
            </div>

        </div>
    </td>

    <!-- DURATION -->
    <td class="px-10 py-6">
        <p class="text-xs font-bold text-slate-700">
            ⏱ ${test.duration ?? 0} mins
        </p>
    </td>

    <!-- QUESTIONS -->
    <td class="px-10 py-6">
        <p class="text-xs font-bold text-slate-700">
            ❓ ${test.questions_count}
        </p>
    </td>

    <!-- LEVEL -->
    <td class="px-10 py-6">
        ${badge}
    </td>

    <!-- ACTIONS -->
    <td class="px-10 py-6">
        <div class="flex justify-center items-center gap-3">

            <!-- VIEW -->
            <button onclick="viewTest(${test.id})"
                class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-blue-600 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm"
                title="View">
                <i class="fas fa-eye text-[10px]"></i>
            </button>

            <!-- EDIT -->
            <button
                onclick="editTest(${test.id})"
                class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm"
                title="Edit">
                <i class="fas fa-edit text-[10px]"></i>
            </button>

            <!-- DELETE -->
            <button
                class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:text-red-500 hover:bg-white border border-transparent hover:border-slate-100 transition-all hover:shadow-sm"
                title="Delete">
                <i class="fas fa-trash text-[10px]"></i>
            </button>

        </div>
    </td>

</tr>
`;
                            });
                        }

                        document.getElementById("testTableBody").innerHTML = html;
                    })
                    .catch(err => {
                        console.error(err);
                        document.getElementById("testTableBody").innerHTML = `
                <tr>
                    <td colspan="5" class="text-center py-10 text-red-500">
                        Failed to load tests
                    </td>
                </tr>`;
                    });
            }

        });
    </script>
@endpush
