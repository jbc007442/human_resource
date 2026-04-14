@extends('dashboard.base')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">

        <div class="mb-12 text-center">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create Company Profile</h1>
            <p class="text-slate-500 mt-2">Complete these steps to showcase your company to top talent.</p>

            <div class="flex items-center justify-center mt-8 gap-4">

                <div class="flex items-center gap-3 step-header active" data-step="1">
                    <span class="step-num ...">1</span>
                    <span class="font-semibold text-sm">Overview</span>
                </div>

                <div class="w-12 h-px bg-slate-200"></div>

                <div class="flex items-center gap-3 step-header text-slate-400" data-step="2">
                    <span class="step-num ...">2</span>
                    <span class="font-semibold text-sm">Why Join Us</span>
                </div>

                <div class="w-12 h-px bg-slate-200"></div>

                <div class="flex items-center gap-3 step-header text-slate-400" data-step="3">
                    <span class="step-num ...">3</span>
                    <span class="font-semibold text-sm">Company Details</span>
                </div>

            </div>
        </div>

        <form method="POST" action="{{ route('company.save') }}" enctype="multipart/form-data">
            @csrf


            <div class="step-content transition-all duration-300" id="step-1">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                        <h2 class="text-xl font-bold text-slate-800">Company Information</h2>
                        <p class="text-sm text-slate-500">The basic details that will appear on your public profile.</p>
                    </div>

                    <div class="p-8">
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-slate-700 mb-3">
                                Company Logo
                            </label>

                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden">

                                    @if (!empty($company->logo))
                                        <!-- ✅ Preview -->
                                        <div class="logo-preview relative h-full w-full p-2 group">
                                            <img src="{{ asset('storage/' . $company->logo) }}"
                                                class="h-full w-full object-contain rounded-xl" />

                                            <div
                                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity rounded-2xl">
                                                <i class="fa-solid fa-camera text-white mb-1"></i>
                                                <span class="text-white text-[10px] font-bold">Change Logo</span>
                                            </div>
                                        </div>
                                    @else
                                        <!-- ✅ Placeholder -->
                                        <div class="placeholder flex flex-col items-center justify-center pt-5 pb-6">
                                            <i class="fa-solid fa-cloud-arrow-up text-slate-400 text-2xl mb-2"></i>
                                            <p class="text-xs text-slate-500">
                                                Click to upload or drag and drop
                                            </p>
                                        </div>
                                    @endif

                                    <!-- ✅ ONLY ONE INPUT -->
                                    <input type="file" name="logo" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                        <!-- FORM FIELDS -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                            <div class="space-y-1">
                                <label class="label-pro">Company Name</label>
                                <input type="text" name="company_name"
                                    value="{{ old('company_name', $company->company_name ?? '') }}" class="input-pro"
                                    placeholder="e.g. Stripe">
                            </div>

                            <div class="space-y-1">
                                <label class="label-pro">CEO Name</label>
                                <input type="text" name="ceo" value="{{ old('ceo', $company->ceo ?? '') }}"
                                    class="input-pro" placeholder="e.g. Patrick Collison">
                            </div>

                            <div class="md:col-span-2 space-y-1">
                                <label class="label-pro">About Company</label>
                                <textarea name="about" rows="4" class="input-pro resize-none" placeholder="Describe your mission...">{{ old('about', $company->about ?? '') }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="step-content hidden transition-all duration-300" id="step-2">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

                    <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Culture & Benefits</h2>
                            <p class="text-sm text-slate-500">What makes your workplace unique?</p>
                        </div>

                        <button type="button" id="addBenefit"
                            class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-semibold text-sm hover:bg-indigo-100 transition-colors">
                            <i class="fa fa-plus mr-1"></i> Add Benefit
                        </button>
                    </div>

                    <div class="p-8">
                        <div id="benefitsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            @php
                                $benefits = old('benefits', $company->benefits ?? []);
                            @endphp

                            @forelse($benefits as $i => $benefit)
                                <div
                                    class="benefit-item group bg-slate-50/50 p-6 rounded-2xl border border-slate-100 relative">

                                    <button type="button"
                                        class="removeBenefit absolute -top-2 -right-2 w-8 h-8 rounded-full bg-white shadow-md text-red-500 hover:text-red-700 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fa fa-times"></i>
                                    </button>

                                    <div class="space-y-4">

                                        <!-- TITLE -->
                                        <div>
                                            <label class="label-pro">Benefit Title</label>
                                            <input type="text" name="benefits[{{ $i }}][title]"
                                                value="{{ $benefit['title'] ?? '' }}" placeholder="Health Insurance"
                                                class="input-pro bg-white">
                                        </div>

                                        <!-- DESCRIPTION -->
                                        <div>
                                            <label class="label-pro">Description</label>
                                            <textarea name="benefits[{{ $i }}][desc]" rows="2" placeholder="Comprehensive coverage..."
                                                class="input-pro bg-white resize-none">{{ $benefit['desc'] ?? '' }}</textarea>
                                        </div>

                                        <!-- ICON -->
                                        <div class="icon-wrapper">
                                            <label class="label-pro text-[11px] uppercase text-slate-400">
                                                FontAwesome Icon Class
                                            </label>

                                            <div class="flex items-center gap-3 mt-1">
                                                <input type="text" name="benefits[{{ $i }}][icon]"
                                                    value="{{ $benefit['icon'] ?? 'fa-star' }}"
                                                    class="input-pro bg-white icon-input">

                                                <div
                                                    class="icon-preview w-12 h-12 flex-shrink-0 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shadow-sm">
                                                    <i class="fa-solid {{ $benefit['icon'] ?? 'fa-star' }}"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @empty
                                <div
                                    class="benefit-item group bg-slate-50/50 p-6 rounded-2xl border border-slate-100 relative">
                                    <div class="space-y-4">

                                        <div>
                                            <label class="label-pro">Benefit Title</label>
                                            <input type="text" name="benefits[0][title]"
                                                placeholder="Health Insurance" class="input-pro bg-white">
                                        </div>

                                        <div>
                                            <label class="label-pro">Description</label>
                                            <textarea name="benefits[0][desc]" rows="2" placeholder="Comprehensive coverage..."
                                                class="input-pro bg-white resize-none"></textarea>
                                        </div>

                                        <div class="icon-wrapper">
                                            <label class="label-pro text-[11px] uppercase text-slate-400">
                                                FontAwesome Icon Class
                                            </label>

                                            <div class="flex items-center gap-3 mt-1">
                                                <input type="text" name="benefits[0][icon]" value="fa-heart-pulse"
                                                    class="input-pro bg-white icon-input">

                                                <div
                                                    class="icon-preview w-12 h-12 flex-shrink-0 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shadow-sm">
                                                    <i class="fa-solid fa-heart-pulse"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>


            <div class="step-content hidden transition-all duration-300" id="step-3">
                <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

                    <div class="p-8 border-b border-slate-50 bg-slate-50/30">
                        <h2 class="text-xl font-bold text-slate-800">Company Details</h2>
                        <p class="text-sm text-slate-500">Provide specific data to help candidates understand your
                            company's scale.</p>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Founded Year</label>
                                <div class="relative group">
                                    <input type="number" name="founded"
                                        value="{{ old('founded', $company->founded ?? '') }}" placeholder="e.g. 2010"
                                        class="input-pro pl-11">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Company Size</label>
                                <div class="relative group">
                                    <input type="text" name="size" value="{{ old('size', $company->size ?? '') }}"
                                        placeholder="e.g. 100-500 Employees" class="input-pro pl-11">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Industry</label>
                                <div class="relative group">
                                    <input type="text" name="industry"
                                        value="{{ old('industry', $company->industry ?? '') }}"
                                        placeholder="e.g. Fintech / SaaS" class="input-pro pl-11">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Annual Revenue</label>
                                <div class="relative group">
                                    <input type="text" name="revenue"
                                        value="{{ old('revenue', $company->revenue ?? '') }}"
                                        placeholder="e.g. $10M - $50M" class="input-pro pl-11">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Headquarters</label>
                                <div class="relative group">
                                    <input type="text" name="hq" value="{{ old('hq', $company->hq ?? '') }}"
                                        placeholder="e.g. San Francisco, CA" class="input-pro pl-11">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700 ml-1">Website URL</label>
                                <div class="relative group">
                                    <input type="text" name="website"
                                        value="{{ old('website', $company->website ?? '') }}"
                                        placeholder="https://example.com" class="input-pro pl-11">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4">
                <button type="button" id="prevBtn" class="px-8 py-3 text-slate-600 font-semibold hidden">Back</button>
                <div class="ml-auto flex gap-4">
                    <button type="button" id="nextBtn"
                        class="px-8 py-3 bg-slate-800 text-white rounded-xl font-semibold">Next Step</button>
                    <button type="submit" id="submitBtn"
                        class="px-8 py-3 bg-emerald-500 text-white rounded-xl font-semibold hidden">
                        {{ isset($company) ? 'Update Profile' : 'Create Profile' }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <style>
        /* Custom Utility Classes for cleaner HTML */
        .label-pro {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #475569;
            /* slate-600 */
            margin-bottom: 0.5rem;
        }

        .input-pro {
            width: 100%;
            background-color: #f8fafc;
            /* slate-50 */
            border: 1px solid #e2e8f0;
            /* slate-200 */
            border-radius: 1rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-pro:focus {
            background-color: #fff;
            border-color: #6366f1;
            /* indigo-500 */
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .btn-primary {
            background-color: #0f172a;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #1e293b;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-success {
            background-color: #059669;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        /* Stepper Styling */
        .step-header.active .step-num {
            border-color: #6366f1;
            background-color: #6366f1;
            color: white;
            padding: 12px;
            border-radius: 100%;
        }

        .step-header.active {
            color: #0f172a;
        }

        /*  Animation   */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-content:not(.hidden) {
            animation: slideIn 0.4s ease-out forwards;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            /**
             * 1. MULTI-STEP FORM LOGIC
             */
            let currentStep = 1;
            const totalSteps = 3;

            const steps = document.querySelectorAll(".step-content");
            const stepHeaders = document.querySelectorAll(".step-header");
            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            const submitBtn = document.getElementById("submitBtn");

            function updateUI() {
                steps.forEach(s => s.classList.add("hidden"));
                const activeStep = document.getElementById(`step-${currentStep}`);
                if (activeStep) activeStep.classList.remove("hidden");

                stepHeaders.forEach(item => {
                    const stepNum = parseInt(item.getAttribute('data-step'));
                    item.classList.toggle("active", stepNum === currentStep);
                    item.classList.toggle("completed", stepNum < currentStep);
                });

                prevBtn.classList.toggle("hidden", currentStep === 1);
                nextBtn.classList.toggle("hidden", currentStep === totalSteps);
                submitBtn.classList.toggle("hidden", currentStep !== totalSteps);

                activeStep?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            nextBtn.addEventListener("click", () => {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateUI();
                }
            });
            prevBtn.addEventListener("click", () => {
                if (currentStep > 1) {
                    currentStep--;
                    updateUI();
                }
            });


            /**
             * 2. DYNAMIC BENEFITS LOGIC
             */
            const container = document.getElementById("benefitsContainer");
            const addBtn = document.getElementById("addBenefit");

            function getNextIndex() {
                return container.querySelectorAll(".benefit-item").length;
            }

            function initIcons() {
                document.querySelectorAll(".icon-input").forEach(input => {

                    const iconClass = input.value.trim() || "fa-star";
                    const wrapper = input.closest(".icon-wrapper") || input.parentElement;
                    const preview = wrapper.querySelector(".icon-preview i");

                    if (preview) {
                        preview.className = `fa-solid ${iconClass}`;
                    }
                });
            }

            addBtn.addEventListener("click", function() {
                const index = getNextIndex();
                const div = document.createElement("div");
                div.className =
                    "benefit-item group bg-slate-50/50 p-6 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:bg-white transition-all duration-300 relative";

                div.innerHTML = `
                <button type="button" class="removeBenefit absolute -top-2 -right-2 w-8 h-8 rounded-full bg-white shadow-md text-red-500 hover:text-red-700 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fa fa-times"></i>
                </button>
                <div class="space-y-4">
                    <div>
                        <label class="label-pro">Benefit Title</label>
                        <input type="text" name="benefits[${index}][title]" placeholder="Health Insurance" class="input-pro bg-white">
                    </div>
                    <div>
                        <label class="label-pro">Description</label>
                        <textarea name="benefits[${index}][desc]" rows="2" class="input-pro bg-white resize-none" placeholder="Comprehensive coverage for..."></textarea>
                    </div>
                    <div class="icon-wrapper">
                        <label class="label-pro text-[11px] uppercase text-slate-400">FontAwesome Icon Class</label>
                        <div class="flex items-center gap-3 mt-1">
                            <input type="text" name="benefits[${index}][icon]" value="fa-star" class="input-pro bg-white icon-input">
                            <div class="icon-preview w-12 h-12 flex-shrink-0 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 shadow-sm">
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                container.appendChild(div);
                updateRemoveButtons();
            });

            document.addEventListener("click", function(e) {
                const btn = e.target.closest(".removeBenefit");
                if (btn) {
                    btn.closest(".benefit-item").remove();
                    reindexBenefits();
                    updateRemoveButtons();
                }
            });

            document.addEventListener("input", function(e) {
                if (e.target.classList.contains("icon-input")) {
                    const iconClass = e.target.value.trim() || "fa-star";
                    const wrapper = e.target.closest(".icon-wrapper");
                    const previewIcon = wrapper.querySelector(".icon-preview i");
                    previewIcon.className = `fa-solid ${iconClass}`;
                }
            });

            function reindexBenefits() {
                const items = container.querySelectorAll(".benefit-item");
                items.forEach((item, idx) => {
                    item.querySelectorAll("input, textarea").forEach(input => {
                        const name = input.getAttribute("name");
                        if (name) {
                            input.setAttribute("name", name.replace(/benefits\[\d+\]/,
                                `benefits[${idx}]`));
                        }
                    });
                });
            }

            function updateRemoveButtons() {
                const items = container.querySelectorAll(".benefit-item");
                items.forEach(item => {
                    const btn = item.querySelector(".removeBenefit");
                    if (btn) btn.classList.toggle("hidden", items.length === 1);
                });
            }


            /**
             * 3. LOGO PREVIEW LOGIC (FIXED)
             */
            const handleLogoChange = function(e) {
                const file = e.target.files[0];
                const uploadLabel = e.target.parentElement;

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {

                        let previewWrapper = uploadLabel.querySelector('.logo-preview');

                        // ✅ create wrapper only once
                        if (!previewWrapper) {

                            // remove placeholder text ONLY
                            const placeholder = uploadLabel.querySelector('.placeholder');
                            if (placeholder) placeholder.remove();

                            previewWrapper = document.createElement('div');
                            previewWrapper.className = 'logo-preview relative h-full w-full p-2 group';

                            previewWrapper.innerHTML = `
                    <img class="h-full w-full object-contain rounded-xl" />
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex flex-col items-center justify-center transition-opacity rounded-2xl">
                        <i class="fa-solid fa-camera text-white mb-1"></i>
                        <span class="text-white text-[10px] font-bold">Change Logo</span>
                    </div>
                `;

                            uploadLabel.appendChild(previewWrapper);
                        }

                        // ✅ update image only
                        previewWrapper.querySelector('img').src = event.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            };

            document.querySelectorAll('input[name="logo"]').forEach(input => {
                input.addEventListener('change', handleLogoChange);
            });

            // Initialize UI
            updateUI();
            updateRemoveButtons();
            initIcons();
        });
    </script>
@endpush
