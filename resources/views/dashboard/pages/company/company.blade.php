@extends('dashboard.base')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- COMPANY HEADER -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

            <!-- LEFT -->
            <div class="flex items-center gap-4">

                <!-- LOGO -->
                <div class="w-14 h-14 rounded-xl bg-white shadow flex items-center justify-center">

                    @if (!empty($company->logo))
                        <img src="{{ asset('storage/' . $company->logo) }}" class="w-10 h-10 object-contain rounded-lg">
                    @else
                        <div class="w-10 h-10 flex items-center justify-center text-slate-400">
                            <i class="fa fa-building text-xl"></i>
                        </div>
                    @endif

                </div>

                <!-- COMPANY NAME -->
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">
                        {{ $company->company_name ?? 'Add Company Name' }}
                    </h1>
                </div>

            </div>

            <!-- RIGHT: ACTION BUTTONS -->
            <div class="flex items-center gap-3">
                <a href="{{ route('company.edit') }}"
                    class="px-4 py-2 rounded-xl border border-slate-200 text-sm font-medium text-slate-700 hover:bg-slate-100 transition flex items-center gap-2">

                    <i class="fas {{ $company ? 'fa-pen' : 'fa-plus' }} text-sm"></i>

                    {{ $company ? 'Update Company' : 'Create Company' }}

                </a>

            </div>

        </div>

        <!-- TABS -->
        <div class="mt-8 border-b border-slate-200">
            <div class="flex gap-8" id="tabs">

                <button data-tab="overview"
                    class="tab-btn border-b-2 border-slate-900 text-slate-900 font-semibold pb-3 text-sm">
                    Overview
                </button>

                <button data-tab="why" class="tab-btn text-slate-500 pb-3 text-sm">
                    Why Join Us
                </button>

                <button data-tab="details" class="tab-btn text-slate-500 pb-3 text-sm">
                    Company Details
                </button>

                <button data-tab="jobs" class="tab-btn text-slate-500 pb-3 text-sm">
                    Jobs
                </button>

            </div>
        </div>

        <!-- CONTENT AREA -->
        <div class="mt-8">

            <!-- OVERVIEW -->
            <div id="overview" class="tab-content">
                <div class="bg-white p-8 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-slate-100">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div class="flex items-center gap-3">
                            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Corporate Overview</h2>
                            <div
                                class="flex items-center gap-1.5 px-3 py-1 bg-emerald-50 border border-emerald-100 rounded-full">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                <span class="text-emerald-700 text-[10px] font-bold uppercase tracking-wider">Verified
                                    Entity</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-sm font-medium text-slate-500">
                            <div class="flex items-center gap-2">
                                <i class="fa fa-chart-line text-indigo-500"></i>
                                <span>Publicly Traded (LSE: STAN)</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-10 items-start">

                        <div class="lg:col-span-2">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Mission & Vision
                            </h3>

                            <p class="text-slate-600 text-lg leading-[1.8] font-light italic">
                                {{ $company->about ?? 'N/A' }}
                            </p>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8">

                                <!-- FOUNDED -->
                                <div class="p-4 border-l-2 border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Founded</p>
                                    <p class="text-xl font-bold text-slate-900">
                                        {{ $company->founded ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- COMPANY SIZE -->
                                <div class="p-4 border-l-2 border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Company Size</p>
                                    <p class="text-xl font-bold text-slate-900">
                                        {{ $company->size ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- INDUSTRY -->
                                <div class="p-4 border-l-2 border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Industry</p>
                                    <p class="text-xl font-bold text-slate-900">
                                        {{ $company->industry ?? 'N/A' }}
                                    </p>
                                </div>

                                <!-- HEADQUARTERS -->
                                <div class="p-4 border-l-2 border-slate-100">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">Headquarters</p>
                                    <p class="text-xl font-bold text-slate-900">
                                        {{ $company->hq ?? 'N/A' }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="space-y-4">

                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">
                                Leadership
                            </h3>

                            <!-- CEO CARD -->
                            <div
                                class="group p-5 bg-slate-50 rounded-2xl border border-transparent hover:border-indigo-100 hover:bg-white transition-all duration-300">

                                <div class="flex items-center gap-4">

                                    <div class="relative">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center text-white text-xl shadow-lg shadow-indigo-200">
                                            <i class="fa fa-user-tie"></i>
                                        </div>
                                        <span
                                            class="absolute -bottom-1 -right-1 w-5 h-5 bg-white rounded-full flex items-center justify-center shadow-sm">
                                            <i class="fa fa-check-circle text-blue-500 text-[10px]"></i>
                                        </span>
                                    </div>

                                    <div>
                                        <p class="text-sm font-bold text-slate-900">
                                            {{ $company->ceo ?? 'Not Added' }}
                                        </p>

                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-16 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                                <div class="w-[80%] h-full bg-emerald-500"></div>
                                            </div>
                                            <span class="text-[10px] font-bold text-emerald-600">
                                                Verified
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- WEBSITE CARD -->
                            @if (!empty($company->website))
                                <a href="{{ $company->website }}" target="_blank"
                                    class="flex items-center justify-between p-5 bg-indigo-600 rounded-2xl text-white hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 group">

                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                                            <i class="fa fa-globe text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-bold text-indigo-100 uppercase tracking-widest">
                                                Website
                                            </p>
                                            <p class="text-sm font-bold">
                                                {{ parse_url($company->website, PHP_URL_HOST) }}
                                            </p>
                                        </div>
                                    </div>

                                    <i class="fa fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            @else
                                <div class="p-5 bg-slate-100 rounded-2xl text-slate-400 text-sm text-center">
                                    No website added
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- WHY JOIN US -->

        <div id="why" class="tab-content hidden">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Why Join Us</h2>
                        <p class="text-slate-500 text-sm">Discover what makes our culture unique</p>
                    </div>
                    <span
                        class="bg-blue-50 text-blue-600 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        Benefits
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @if ($company && $company->benefits->count())
                        @foreach ($company->benefits as $benefit)
                            <div
                                class="group p-4 rounded-2xl border border-slate-50 hover:border-indigo-100 hover:bg-indigo-50/30 transition-all duration-300">

                                <div class="flex items-start space-x-4">

                                    <!-- ICON -->
                                    <div
                                        class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                                        <i class="fa {{ $benefit->icon ?? 'fa-star' }}"></i>
                                    </div>

                                    <!-- TEXT -->
                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            {{ $benefit->title ?? 'No Title' }}
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $benefit->description ?? 'No description available' }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- EMPTY STATE -->
                        <div class="col-span-full text-center py-10">
                            <p class="text-slate-400 text-sm italic">
                                No benefits added yet.
                            </p>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- COMPANY DETAILS -->
        <div id="details" class="tab-content hidden">
            <div class="bg-white p-8 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Company Details</h2>
                        <p class="text-sm text-slate-500 mt-1">Key metrics and verified information</p>
                    </div>

                    <span
                        class="px-3 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-wider rounded-full">
                        ID: {{ $company->id ?? 'N/A' }}
                    </span>
                </div>

                <!-- STATS -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">

                    @php
                        $details = [
                            ['label' => 'Founded', 'value' => $company?->founded],
                            ['label' => 'Size', 'value' => $company?->size],
                            ['label' => 'Industry', 'value' => $company?->industry],
                            [
                                'label' => 'Revenue',
                                'value' => $company?->revenue ? '₹' . number_format($company->revenue) : null,
                            ],
                            ['label' => 'Office', 'value' => $company?->hq],
                        ];
                    @endphp

                    @foreach ($details as $item)
                        <div
                            class="group p-5 bg-slate-50 border border-transparent hover:border-indigo-100 hover:bg-white hover:shadow-md transition-all duration-300 rounded-2xl">
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-tight">
                                {{ $item['label'] }}
                            </p>
                            <p class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                {{ $item['value'] ?? 'N/A' }}
                            </p>
                        </div>
                    @endforeach

                </div>

                <!-- WEBSITE -->
                @if (!empty($company->website))
                    <a href="{{ $company->website }}" target="_blank"
                        class="group col-span-full p-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-between transition-transform duration-300 active:scale-[0.98]">

                        <div
                            class="bg-white/95 w-full h-full p-5 rounded-[calc(1rem-1px)] flex justify-between items-center">

                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600">
                                    <i class="fa fa-link text-lg"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest">
                                        Official Website
                                    </p>
                                    <p class="text-lg font-bold text-slate-900">
                                        {{ parse_url($company->website, PHP_URL_HOST) }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mr-2 w-10 h-10 rounded-full flex items-center justify-center border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                <i class="fa fa-external-link-alt text-sm"></i>
                            </div>

                        </div>
                    </a>
                @endif

                <!-- CONTACT -->
                <div class="mt-10 pt-8 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-600 rounded-full"></span>
                        Contact & Social Media
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                        <!-- EMAIL -->
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                            <div class="w-10 h-10 bg-white border rounded-xl flex items-center justify-center">
                                <i class="fa fa-envelope text-indigo-500"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Email</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $company->user->email ?? 'Not available' }}
                                </p>
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                            <div class="w-10 h-10 bg-white border rounded-xl flex items-center justify-center">
                                <i class="fa fa-phone text-emerald-500"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Phone</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $company->user->phone ?? 'Not available' }}
                                </p>
                            </div>
                        </div>

                        <!-- LINKEDIN -->
                        @if (!empty($company->linkedin))
                            <a href="{{ $company->linkedin }}" target="_blank"
                                class="flex items-center gap-4 p-4 bg-blue-50 rounded-2xl">
                                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                                    <i class="fa-brands fa-linkedin"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-blue-400 uppercase">LinkedIn</p>
                                    <p class="font-semibold text-blue-700">View Profile</p>
                                </div>
                            </a>
                        @endif

                        <!-- INSTAGRAM -->
                        @if (!empty($company->instagram))
                            <a href="{{ $company->instagram }}" target="_blank"
                                class="flex items-center gap-4 p-4 bg-pink-50 rounded-2xl">
                                <div
                                    class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 rounded-xl flex items-center justify-center text-white">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-pink-400 uppercase">Instagram</p>
                                    <p class="font-semibold text-pink-700">View Profile</p>
                                </div>
                            </a>
                        @endif

                    </div>
                </div>

            </div>
        </div>

        <!-- JOBS -->
        <div id="jobs" class="tab-content hidden">
            <div class="space-y-4">

                <!-- HEADER -->
                <div class="flex items-center justify-between px-2 mb-2">
                    <h2 class="text-lg font-bold text-slate-800">
                        Open Opportunities
                        <span class="text-slate-400 font-normal ml-1">
                            ({{ $company ? $company->jobs->count() : 0 }})
                        </span>
                    </h2>

                    <a href="{{ route('job.list') }}"
                        class="text-sm text-indigo-600 font-semibold hover:text-indigo-700">
                        View all jobs
                    </a>
                </div>

                <!-- JOB LIST -->
                @if ($company && $company->jobs->count())
                    @foreach ($company->jobs as $job)
                        <div
                            class="group bg-white p-5 rounded-2xl border border-slate-100 shadow-sm hover:border-indigo-100 hover:shadow-md transition-all duration-300 cursor-pointer">

                            <div class="flex justify-between items-start">

                                <div class="flex gap-4">
                                    <!-- ICON -->
                                    <div
                                        class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-indigo-50 group-hover:text-indigo-600 transition-colors">
                                        <i class="fa fa-briefcase text-xl"></i>
                                    </div>

                                    <!-- JOB INFO -->
                                    <div>
                                        <h3 class="font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            {{ $job->title }}
                                        </h3>

                                        <div class="flex items-center gap-3 mt-1">
                                            <span class="text-sm text-slate-500 flex items-center gap-1">
                                                <i class="fa fa-map-marker-alt text-xs"></i>
                                                {{ $job->location ?? 'N/A' }}
                                            </span>

                                            <span class="text-slate-300">•</span>

                                            <span class="text-sm text-slate-500">
                                                {{ ucfirst($job->type) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- TIME -->
                                <span class="text-xs font-medium text-slate-400 bg-slate-50 px-2 py-1 rounded-md">
                                    {{ $job->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <!-- TAGS -->
                            <div class="mt-4 flex flex-wrap gap-2">

                                @if ($job->department)
                                    <span
                                        class="text-[11px] font-semibold uppercase text-slate-500 bg-slate-100 px-2 py-1 rounded-lg">
                                        {{ $job->department }}
                                    </span>
                                @endif

                                @if ($job->salary)
                                    <span
                                        class="text-[11px] font-semibold uppercase text-slate-500 bg-slate-100 px-2 py-1 rounded-lg">
                                        ₹{{ $job->salary }}
                                    </span>
                                @endif

                                <!-- STATUS -->
                                <span
                                    class="text-[11px] font-semibold uppercase 
                            {{ $job->status === 'active' ? 'text-green-600 bg-green-50' : 'text-gray-500 bg-gray-100' }} 
                            px-2 py-1 rounded-lg">
                                    {{ $job->status }}
                                </span>

                            </div>

                            <!-- APPLICANTS & VIEW BUTTON -->
                            <div class="mt-4 flex items-center justify-between">

                                <!-- 👥 Total Applicants -->
                                <span class="text-sm text-indigo-600 font-semibold">
                                    {{ $job->applications_count }} Applicants
                                </span>

                                <!-- 🔗 View Applicants Button -->
                                <a href="{{ route('jobs.applicants', $job->id) }}"
                                    class="text-sm font-semibold text-white bg-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                                    View Applicants
                                </a>

                            </div>

                        </div>
                    @endforeach
                @else
                    <!-- EMPTY STATE -->
                    <div class="text-center py-10 text-slate-400">
                        No jobs posted yet 🚀
                        <br>

                        @if (!$company)
                            <a href="{{ route('company.edit') }}" class="text-indigo-600 font-semibold">
                                Create your company first
                            </a>
                        @endif
                    </div>
                @endif

            </div>
        </div>

    </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tabs = document.querySelectorAll(".tab-btn");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {

                    // 1. Reset all tabs
                    tabs.forEach(t => {
                        t.classList.remove(
                            "border-b-2",
                            "border-slate-900",
                            "text-slate-900",
                            "font-semibold"
                        );
                        t.classList.add("text-slate-500");
                    });

                    // 2. Hide all content
                    contents.forEach(c => c.classList.add("hidden"));

                    // 3. Activate clicked tab
                    this.classList.add(
                        "border-b-2",
                        "border-slate-900",
                        "text-slate-900",
                        "font-semibold"
                    );
                    this.classList.remove("text-slate-500");

                    // 4. Show correct content
                    const tabId = this.getAttribute("data-tab");
                    document.getElementById(tabId).classList.remove("hidden");

                });
            });

        });
    </script>
@endpush
