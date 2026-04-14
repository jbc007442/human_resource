@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto px-8 py-12 antialiased">

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 pb-6 border-b border-slate-100">
            <div class="space-y-1">
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">
                    Job Postings
                </h1>
                <p class="text-slate-500 text-lg font-medium max-w-md">
                    Manage, monitor, and update your active career listings from one central dashboard.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button onclick="openUploadModal()"
                    class="inline-flex items-center justify-center px-5 py-3 bg-white text-slate-700 text-sm font-semibold rounded-xl border border-slate-200 shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-slate-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Bulk Upload
                </button>

                <a href="{{ route('create.jobs') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white text-sm font-bold rounded-xl shadow-md shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 -translate-y-[1px] active:translate-y-0 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Post New Job
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-200/60 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400">Position
                                & Location</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400">Contract
                            </th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400">Salary
                                Range</th>
                            <th class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400">Status
                            </th>
                            <th
                                class="px-8 py-5 text-[11px] font-black uppercase tracking-[0.1em] text-slate-400 text-right">
                                Operations</th>
                        </tr>
                    </thead>

                    <tbody id="jobs-table" class="divide-y divide-slate-50">
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 border-4 border-indigo-100 border-t-indigo-600 rounded-full animate-spin">
                                    </div>
                                    <p class="mt-4 text-slate-400 font-medium">Fetching job listings...</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div id="uploadModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">
                    <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-xl">

                        <h2 class="text-lg font-bold mb-4">Upload Excel File</h2>

                        <form action="{{ route('jobs.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="file" name="file" required
                                class="w-full mb-4 border border-slate-200 p-3 rounded-xl">

                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="closeUploadModal()"
                                    class="px-4 py-2 text-sm bg-slate-100 rounded-xl">
                                    Cancel
                                </button>

                                <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm rounded-xl">
                                    Upload
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('jobs-table');

            function loadJobs() {
                fetch("{{ route('jobs.data') }}")
                    .then(res => res.json())
                    .then(data => {
                        table.innerHTML = '';

                        if (data.length === 0) {
                            table.innerHTML = `
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-medium">No jobs posted yet. Start by creating one!</p>
                            </td>
                        </tr>`;
                            return;
                        }

                        data.forEach(job => {
                            const statusConfig = job.status === 'active' ? {
                                bg: 'bg-emerald-50',
                                text: 'text-emerald-700',
                                dot: 'bg-emerald-500',
                                label: 'Active'
                            } : {
                                bg: 'bg-slate-100',
                                text: 'text-slate-600',
                                dot: 'bg-slate-400',
                                label: 'Inactive'
                            };

                            table.innerHTML += `
                        <tr class="group hover:bg-indigo-50/30 transition-colors">
                            <td class="px-8 py-6">
                                <div class="font-bold text-slate-800 text-base">${job.title}</div>
                                <div class="text-slate-400 text-xs mt-0.5 flex items-center">
                                    <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    ${job.location ?? 'Remote'}
                                </div>
                            </td>
                            
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold border border-slate-200/50">
                                    ${job.type}
                                </span>
                            </td>

                            <td class="px-8 py-6 font-semibold text-slate-700 italic">
                                ₹${parseInt(job.salary).toLocaleString('en-IN') ?? 0}
                            </td>

                            <td class="px-8 py-6">
                                <button onclick="toggleStatus(${job.id}, this)" 
                                    class="relative inline-flex items-center gap-2 px-4 py-1.5 rounded-full transition-all active:scale-95 border border-transparent hover:border-indigo-200 ${statusConfig.bg} ${statusConfig.text}">
                                    <span class="relative flex h-2 w-2">
                                        ${job.status === 'active' ? '<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>' : ''}
                                        <span class="relative inline-flex rounded-full h-2 w-2 ${statusConfig.dot}"></span>
                                    </span>
                                    <span class="text-[11px] font-black uppercase tracking-wider">${statusConfig.label}</span>
                                </button>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
    <a href="/edit-jobs/${job.id}" 
       class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" 
       title="Edit Job">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
    </a>

    <button onclick="deleteJob(${job.id})" 
        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" 
        title="Delete Job">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
</div>
                            </td>
                        </tr>`;
                        });
                    });
            }

            window.toggleStatus = function(id, btn) {
                // Simple visual feedback
                btn.style.opacity = '0.5';
                btn.style.pointerEvents = 'none';

                fetch(`/jobs/status/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => loadJobs());
            }

            window.deleteJob = function(id) {
                if (!confirm('Are you sure you want to remove this listing?')) return;
                fetch(`/jobs/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => loadJobs());
            }

            loadJobs();
        });


        // Modal functions
        function openUploadModal() {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('uploadModal').classList.add('flex');
        }
        // Close modal when clicking outside the content
        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
        }
    </script>
@endpush
