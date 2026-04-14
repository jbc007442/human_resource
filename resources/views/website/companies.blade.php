@extends('website.base')
@section('content')
    <section class="bg-slate-900 py-12 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="text-left">
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                        Top <span class="text-blue-500">Companies</span>
                    </h1>
                    <p class="text-slate-400 text-sm">Explore culture and careers at leading tech firms.</p>
                </div>

                <div
                    class="glass-effect p-1.5 rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-1 w-full max-w-3xl">
                    <div class="flex items-center w-full px-3 border-r border-slate-700/50">
                        <i class="fas fa-building text-blue-500 text-sm mr-2"></i>
                        <input type="text" placeholder="Company name"
                            class="w-full py-2 bg-transparent focus:outline-none text-slate-900 text-sm placeholder:text-slate-500">
                    </div>
                    <div class="flex items-center w-full px-3">
                        <i class="fas fa-layer-group text-slate-500 text-sm mr-2"></i>

                        <select name="industry"
                            class="w-full py-2 bg-transparent focus:outline-none text-slate-500 text-sm appearance-none cursor-pointer">

                            <option value="">All Industries</option>

                            @foreach ($industries as $industry)
                                <option value="{{ $industry }}"
                                    {{ request('industry') == $industry ? 'selected' : '' }}>
                                    {{ ucfirst($industry) }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <button
                        class="w-full md:w-auto bg-blue-600 text-white px-8 py-2.5 rounded-lg font-semibold hover:bg-blue-500 transition-all text-sm whitespace-nowrap">
                        Find Companies
                    </button>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-4 py-20">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Featured Companies</h2>
                <p class="text-slate-500">Top rated workplaces based on employee satisfaction.</p>
            </div>
            <button class="text-blue-600 font-semibold flex items-center gap-2 hover:gap-3 transition-all">
                View All <i class="fas fa-arrow-right text-sm"></i>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @forelse($companies as $company)
                <div
                    class="job-card glass-effect border-slate-200 p-6 rounded-3xl hover:shadow-xl transition-all cursor-pointer">

                    <!-- LOGO -->
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 overflow-hidden">
                        @if ($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-building text-2xl text-blue-600"></i>
                        @endif
                    </div>

                    <!-- NAME -->
                    <h3 class="text-xl font-bold mb-2">
                        {{ $company->company_name }}
                    </h3>

                    <!-- ABOUT -->
                    <p class="text-slate-500 text-sm mb-6 line-clamp-2">
                        {{ $company->about ?? 'No description available.' }}
                    </p>

                    <!-- TAGS -->
                    <div class="flex items-center gap-4 mb-6">
                        <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                            {{ $company->industry ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <a href="#"
                        class="block text-center w-full py-3 bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-900 font-bold rounded-xl transition-colors">
                        {{ $company->jobs->count() }} Openings
                    </a>
                </div>

            @empty
                <p class="text-slate-500">No companies found.</p>
            @endforelse

        </div>
    </main>
@endsection
