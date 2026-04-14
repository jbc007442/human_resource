@extends('website.base')
@section('content')
<div class="bg-white">
    <section class="relative py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <nav class="flex items-center gap-2 text-xs font-bold text-indigo-600 uppercase tracking-[0.3em] mb-6">
                    <span>Established 2026</span>
                </nav>
                <h1 class="text-5xl md:text-6xl font-light text-slate-900 leading-[1.1] tracking-tight mb-8">
                    Redefining the synergy between <span class="font-semibold italic">talent</span> and <span class="font-semibold">opportunity.</span>
                </h1>
                <p class="text-xl text-slate-500 leading-relaxed font-light">
                    JobSync was founded on a simple premise: the path to a dream career shouldn't be a maze. We build the bridges that connect world-class professionals with visionary companies.
                </p>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50 -z-0 hidden lg:block" style="clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);"></div>
    </section>

    <section class="py-20 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div class="space-y-12">
                    <div>
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Our Mission</h2>
                        <p class="text-2xl text-slate-800 font-medium leading-snug">
                            To empower every professional with the tools of a modern job seeker—precision, intelligence, and speed.
                        </p>
                    </div>
                    <div>
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Our Vision</h2>
                        <p class="text-2xl text-slate-800 font-medium leading-snug">
                            Creating a world where recruitment is transparent, and merit is the only currency that matters.
                        </p>
                    </div>
                </div>
                
                <div class="bg-slate-900 rounded-[3rem] p-12 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden">
                    <div class="grid grid-cols-2 gap-8 relative z-10">
                        <div>
                            <p class="text-4xl font-light mb-1">500k+</p>
                            <p class="text-slate-400 text-xs uppercase tracking-widest font-bold">Active Users</p>
                        </div>
                        <div>
                            <p class="text-4xl font-light mb-1">12k+</p>
                            <p class="text-slate-400 text-xs uppercase tracking-widest font-bold">Partners</p>
                        </div>
                        <div>
                            <p class="text-4xl font-light mb-1">98%</p>
                            <p class="text-slate-400 text-xs uppercase tracking-widest font-bold">Success Rate</p>
                        </div>
                        <div>
                            <p class="text-4xl font-light mb-1">24/7</p>
                            <p class="text-slate-400 text-xs uppercase tracking-widest font-bold">Expert Support</p>
                        </div>
                    </div>
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-500/20 blur-[100px] rounded-full"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-3xl font-semibold text-slate-900">The Principles We Stand By</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="group">
                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-slate-900 shadow-sm mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-fingerprint text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Authentic Connections</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        We prioritize human-centric interactions over algorithmic sorting, ensuring every match feels right.
                    </p>
                </div>

                <div class="group">
                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-slate-900 shadow-sm mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-shield-halved text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Integrity First</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Your data and your journey are sacred. We maintain the highest standards of privacy and ethical AI.
                    </p>
                </div>

                <div class="group">
                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-slate-900 shadow-sm mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <i class="fas fa-wand-magic-sparkles text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Modern Innovation</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        By leveraging cutting-edge technology, we simplify complex hiring processes into elegant experiences.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-indigo-50 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
                <h2 class="text-4xl font-light text-slate-900 mb-8 relative z-10">Ready to start your <span class="font-bold">next chapter?</span></h2>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                    <a href="{{ url('/register') }}" class="bg-slate-900 text-white px-10 py-4 rounded-full font-bold shadow-xl hover:bg-slate-800 transition-all">Join JobSync</a>
                    <a href="{{ url('/contact') }}" class="text-slate-600 font-bold px-10 py-4 hover:bg-white rounded-full transition-all">Get in Touch</a>
                </div>
                <div class="absolute -left-10 -bottom-10 text-slate-200/50">
                    <i class="fas fa-briefcase text-[12rem]"></i>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection