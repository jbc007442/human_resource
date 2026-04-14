<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Users
        $totalUsers = User::count();

        // Total Companies
        $totalCompanies = User::where('role', 'company')->count();

        // Total Jobseekers
        $totalJobseekers = User::where('role', 'jobseeker')->count();

        return view('dashboard.pages.user.dashboard', compact(
            'totalUsers',
            'totalCompanies',
            'totalJobseekers'
        ));
    }


    // New method to fetch all companies
    public function allCompanies()
    {
        // ✅ Count only jobs created by that company (via user_id)
        $companies = Company::withCount('jobs')->latest()->get();

        return view('dashboard.pages.user.allcompany', compact('companies'));
    }


    // New method to fetch jobs by company
    public function jobsByCompany($company_id)
    {
        $company = Company::findOrFail($company_id);

        // ✅ Only jobs created by this company
        $jobs = Job::where('user_id', $company->user_id)
            ->withCount('applications')
            ->latest()
            ->get();

        return view('dashboard.pages.user.getjobbycompany', compact('company', 'jobs'));
    }

    // New method to fetch applicants for a job
    public function applicants($job_id)
    {
        $job = Job::findOrFail($job_id);

        // ✅ Get applications for this job only
        $applications = Application::with('user')
            ->where('job_id', $job_id)
            ->latest()
            ->get();

        return view('dashboard.pages.user.jobapplicant', compact('job', 'applications'));
    }


    // New method to fetch applicant details
    public function applicantDetails($id)
    {
        $application = Application::with(['user', 'resume', 'job', 'answers'])
            ->findOrFail($id);

        return view('dashboard.pages.user.applicantbyid', compact('application'));
    }
}
