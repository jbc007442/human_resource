@extends('website.base')
@section('content')
    <div class="bg-white min-h-screen">
        <section class="pt-24 pb-16 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="max-w-3xl">
                    <nav class="flex items-center gap-2 text-xs font-bold text-indigo-600 uppercase tracking-[0.3em] mb-6">
                        <span>Contact Inquiry</span>
                    </nav>
                    <h1 class="text-5xl font-light text-slate-900 leading-tight tracking-tight mb-6">
                        Let’s start a <span class="font-semibold italic">conversation</span> about your future.
                    </h1>
                    <p class="text-xl text-slate-500 font-light leading-relaxed">
                        Whether you are a visionary company looking for talent or a professional seeking your next
                        milestone, our team is here to assist.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-20">

                    <div class="lg:col-span-2 space-y-16">
                        <div>
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Global Headquarters
                            </h3>
                            <div class="space-y-6">
                                <div class="flex gap-6">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-900 flex-shrink-0">
                                        <i class="fas fa-location-dot text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 mb-1">London Office</p>
                                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                            124 Savile Row, Mayfair<br>
                                            London, W1S 3PR, UK
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Digital Channels
                            </h3>
                            <div class="space-y-8">
                                <a href="mailto:concierge@jobsync.com" class="group flex items-center gap-6">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-900 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        <i class="far fa-envelope text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                            General Inquiries</p>
                                        <p
                                            class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            concierge@jobsync.com</p>
                                    </div>
                                </a>

                                <a href="tel:+442079460958" class="group flex items-center gap-6">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-900 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                        <i class="fas fa-phone-volume text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                                            Priority Support</p>
                                        <p
                                            class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            +44 20 7946 0958</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Social Presence
                            </h3>
                            <div class="flex gap-4">
                                <a href="#"
                                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all">
                                    <i class="fab fa-x-twitter"></i>
                                </a>
                                <a href="#"
                                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <div
                            class="bg-white border border-slate-100 p-10 md:p-14 rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)]">

                            <!-- SUCCESS MESSAGE -->
                            @if (session('success'))
                                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl text-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST" class="space-y-8">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                                    <!-- FULL NAME -->
                                    <div class="space-y-2">
                                        <label class="label">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Alexander Carter"
                                            class="input {{ $errors->has('name') ? 'border-red-500' : '' }}">

                                        @error('name')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="space-y-2">
                                        <label class="label">Email Address</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="alex@domain.com"
                                            class="input {{ $errors->has('email') ? 'border-red-500' : '' }}">

                                        @error('email')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- PHONE -->
                                    <div class="space-y-2">
                                        <label class="label">Phone Number</label>
                                        <input type="tel" name="phone" value="{{ old('phone') }}"
                                            placeholder="+91 9876543210"
                                            class="input {{ $errors->has('phone') ? 'border-red-500' : '' }}">

                                        @error('phone')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>

                                <!-- SUBJECT -->
                                <div class="space-y-2">
                                    <label class="label">Subject of Interest</label>
                                    <select name="subject"
                                        class="input text-slate-500 {{ $errors->has('subject') ? 'border-red-500' : '' }}">
                                        <option value="">Select Subject</option>
                                        <option value="Partnership Inquiry"
                                            {{ old('subject') == 'Partnership Inquiry' ? 'selected' : '' }}>
                                            Partnership Inquiry
                                        </option>
                                        <option value="Career Assistance"
                                            {{ old('subject') == 'Career Assistance' ? 'selected' : '' }}>
                                            Career Assistance
                                        </option>
                                        <option value="Technical Support"
                                            {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>
                                            Technical Support
                                        </option>
                                        <option value="Media & Press"
                                            {{ old('subject') == 'Media & Press' ? 'selected' : '' }}>
                                            Media & Press
                                        </option>
                                    </select>

                                    @error('subject')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- MESSAGE -->
                                <div class="space-y-2">
                                    <label class="label">Message</label>
                                    <textarea name="message" rows="5" placeholder="How can we assist you today?"
                                        class="input resize-none {{ $errors->has('message') ? 'border-red-500' : '' }}">{{ old('message') }}</textarea>

                                    @error('message')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- BUTTON -->
                                <button type="submit"
                                    class="w-full bg-slate-900 text-white font-bold py-5 rounded-2xl shadow-xl shadow-slate-100 hover:bg-indigo-600 hover:shadow-indigo-100 transition-all duration-300 uppercase tracking-widest text-xs">
                                    Send Message
                                </button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <style>
        .label {
            font-size: 10px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-left: 4px;
        }

        .input {
            width: 100%;
            background-color: rgba(248, 250, 252, 0.5);
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .input:focus {
            border-color: #6366f1;
            outline: none;
        }

        .error {
            color: #ef4444;
            font-size: 12px;
        }
    </style>
@endsection
