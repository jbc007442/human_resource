@extends('dashboard.base')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-16">

    <div class="text-center mb-16">
        <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">Pricing Plans</h2>
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 mt-2">Elevate your career search</h1>
        <p class="text-slate-500 mt-4 text-lg max-w-2xl mx-auto">Choose the right path for your professional growth with our transparent pricing.</p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 items-start">

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 flex flex-col min-h-[600px] transition-transform hover:-translate-y-2">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-slate-900">Basic</h3>
                <div class="mt-4 flex items-baseline">
                    <span class="text-4xl font-black text-slate-900">₹1,100</span>
                    <span class="text-slate-500 ml-1 text-sm">/one-time</span>
                </div>
                <p class="mt-4 text-slate-500 text-sm leading-relaxed">Essential tools for individuals starting their journey.</p>
            </div>

            <div class="flex-grow">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">What's included</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Apply to 20 jobs monthly
                    </li>
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Standard profile visibility
                    </li>
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Standard email support
                    </li>
                </ul>
            </div>

            <div class="pt-6 border-t border-slate-100">
                @include('components.razorpay-button', ['plan' => 'basic', 'amount' => 1100])
            </div>
        </div>

        <div class="relative bg-slate-900 rounded-3xl shadow-2xl p-8 flex flex-col min-h-[680px] md:-mt-8 transition-transform hover:-translate-y-2">
            <div class="absolute -top-4 inset-x-0 flex justify-center">
                <span class="bg-indigo-500 text-white text-xs font-bold px-4 py-1 rounded-full uppercase tracking-widest shadow-lg">Most Popular</span>
            </div>

            <div class="mb-8">
                <h3 class="text-lg font-bold text-white">Professional</h3>
                <div class="mt-4 flex items-baseline">
                    <span class="text-5xl font-black text-white">₹2,700</span>
                    <span class="text-slate-400 ml-1 text-sm">/one-time</span>
                </div>
                <p class="mt-4 text-slate-400 text-sm leading-relaxed">Everything you need to secure your dream role faster.</p>
            </div>

            <div class="flex-grow">
                <p class="text-xs font-bold uppercase tracking-widest text-indigo-400 mb-4">Premium Features</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-slate-200 text-sm">
                        <svg class="w-5 h-5 text-indigo-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Unlimited job applications
                    </li>
                    <li class="flex items-start text-slate-200 text-sm">
                        <svg class="w-5 h-5 text-indigo-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Featured profile badge
                    </li>
                    <li class="flex items-start text-slate-200 text-sm">
                        <svg class="w-5 h-5 text-indigo-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Priority support (24h)
                    </li>
                    <li class="flex items-start text-slate-200 text-sm">
                        <svg class="w-5 h-5 text-indigo-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Resume boost visibility
                    </li>
                    <li class="flex items-start text-slate-200 text-sm">
                        <svg class="w-5 h-5 text-indigo-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Weekly performance report
                    </li>
                </ul>
            </div>

            <div class="pt-6 border-t border-slate-800">
                @include('components.razorpay-button', ['plan' => 'pro', 'amount' => 2700])
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 flex flex-col min-h-[600px] transition-transform hover:-translate-y-2">
            <div class="mb-8">
                <h3 class="text-lg font-bold text-slate-900">Executive Premium</h3>
                <div class="mt-4 flex items-baseline">
                    <span class="text-4xl font-black text-slate-900">₹5,500</span>
                    <span class="text-slate-500 ml-1 text-sm">/one-time</span>
                </div>
                <p class="mt-4 text-slate-500 text-sm leading-relaxed">Full concierge service and direct access to power players.</p>
            </div>

            <div class="flex-grow">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-4">Ultimate Access</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        All Pro features included
                    </li>
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Direct recruiter contact info
                    </li>
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        AI Resume Optimization
                    </li>
                    <li class="flex items-start text-slate-600 text-sm">
                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Job match priority listing
                    </li>
                </ul>
            </div>

            <div class="pt-6 border-t border-slate-100">
                @include('components.razorpay-button', ['plan' => 'premium', 'amount' => 5500])
            </div>
        </div>

    </div>
</div>




@endsection
