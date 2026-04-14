@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto p-8 antialiased relative">

        @if (session('success'))
            <div id="successAlert"
                class="fixed top-10 right-10 z-50 flex items-center p-4 mb-4 text-emerald-800 border-t-4 border-emerald-500 bg-emerald-50 shadow-lg rounded-lg transition-all"
                role="alert">

                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>

                <div class="ml-3 text-sm font-medium">
                    {{ session('success') }}
                </div>

                <button id="closeAlertBtn"
                    class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg p-1.5 hover:bg-emerald-100 flex items-center justify-center h-8 w-8">
                    ✕
                </button>
            </div>
        @endif

        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-light tracking-tight text-slate-900">Inbound Leads</h1>
                <p class="text-sm text-slate-500 mt-1">Manage and review your latest high-value inquiries.</p>
            </div>
            <button
                class="px-5 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-all duration-200 shadow-sm">
                Export Report
            </button>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600">Client</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600">Contact Info
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600">Subject</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600">Message
                                Preview</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($leads as $lead)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div
                                            class="h-9 w-9 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-medium text-sm border border-slate-200 uppercase">
                                            {{ substr($lead->name, 0, 2) }}
                                        </div>
                                        <span class="ml-3 text-sm font-semibold text-slate-900">{{ $lead->name }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm text-slate-900">{{ $lead->email }}</span>
                                        <span class="text-xs text-slate-500 mt-0.5">{{ $lead->phone }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $lead->subject }}
                                    </span>
                                </td>

                                <td class="px-6 py-5">
                                    <p class="text-sm text-slate-600 truncate max-w-[200px] italic">
                                        "{{ $lead->message }}"
                                    </p>
                                </td>

                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-end space-x-3">
                                        <button class="text-slate-400 hover:text-slate-900 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to remove this lead?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-slate-400 hover:text-red-600 transition-colors p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center text-slate-400 font-light italic">
                                    No leads currently in the system.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertBox = document.getElementById("successAlert");
            const closeBtn = document.getElementById("closeAlertBtn");

            // Auto hide after 4 sec
            setTimeout(() => {
                if (alertBox) {
                    alertBox.style.opacity = "0";
                    alertBox.style.transform = "translateY(-10px)";
                    setTimeout(() => alertBox.remove(), 300);
                }
            }, 4000);

            // Manual close
            if (closeBtn) {
                closeBtn.addEventListener("click", function() {
                    alertBox.style.opacity = "0";
                    alertBox.style.transform = "translateY(-10px)";
                    setTimeout(() => alertBox.remove(), 300);
                });
            }
        });
    </script>
@endpush
