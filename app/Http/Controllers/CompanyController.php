<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyBenefit;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    // 🟢 Overview Page
    public function index()
    {
        $company = Company::with([
            'user',
            'benefits',
            'jobs' => function ($query) {
                $query->withCount('applications') // ✅ count applicants
                    ->with(['applications.user']) // ✅ optional (if needed later)
                    ->latest();
            }
        ])
            ->where('user_id', Auth::id())
            ->first();

        return view('dashboard.pages.company.company', compact('company'));
    }

    // 🟢 Applicants page for a specific jo
    public function applicants($jobId)
    {
        $job = \App\Models\Job::with([
            'applications.user',
            'applications.answers' // ✅ REQUIRED
        ])->findOrFail($jobId);

        // 🔒 Security check
        if ($job->company->user_id !== auth()->id()) {
            abort(403);
        }

        return view('dashboard.pages.company.applicants', compact('job'));
    }


    // 🟢 Create / Edit Page (same form)
    public function edit()
    {
        $company = Company::with('user') // optional
            ->where('user_id', Auth::id())
            ->first();

        return view('dashboard.pages.company.edit-company', compact('company'));
    }

    // 🟢 Save (Create OR Update)
    public function save(Request $request)
    {

        // 🔥 ADD HERE (TOP)
        Log::info('Company save called', $request->all());
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'ceo' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',

            'founded' => 'nullable|numeric',
            'size' => 'nullable|string',
            'industry' => 'nullable|string',
            'revenue' => 'nullable|string',
            'hq' => 'nullable|string',
            'website' => 'nullable|url',

            'benefits' => 'nullable|array',
        ]);

        $company = Company::where('user_id', Auth::id())->first();

        // 📸 Handle logo upload
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {

            // delete old
            if ($company && $company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $validated['logo'] = $request->file('logo')->store('companies', 'public');
        }

        // 🆕 CREATE or UPDATE company
        if ($company) {
            $company->update($validated);
        } else {
            $validated['user_id'] = Auth::id();
            $company = Company::create($validated); // ⚠️ important: assign back
        }

        // 🔥 HANDLE BENEFITS (NEW LOGIC)
        if ($request->benefits) {

            // delete old benefits (important for update)
            $company->benefits()->delete();

            foreach ($request->benefits as $benefit) {
                $company->benefits()->create([
                    'title' => $benefit['title'] ?? null,
                    'description' => $benefit['desc'] ?? null,
                    'icon' => $benefit['icon'] ?? null,
                ]);
            }
        }

        return redirect()->route('company.overview')
            ->with('success', 'Company saved successfully!');
    }

    // 🟢 Public listing page with filters
    public function list(Request $request)
    {
        $query = Company::with('jobs');

        // 🔍 Search filter
        if ($request->search) {
            $query->where('company_name', 'like', '%' . $request->search . '%');
        }

        // 🎯 Industry filter
        if ($request->industry) {
            $query->where('industry', $request->industry);
        }

        $companies = $query->latest()->get();

        // ✅ GET UNIQUE INDUSTRIES FROM DB
        $industries = Company::select('industry')
            ->whereNotNull('industry')
            ->distinct()
            ->pluck('industry');

        return view('website.companies', compact('companies', 'industries'));
    }
}
