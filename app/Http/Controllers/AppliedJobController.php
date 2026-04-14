<?php

namespace App\Http\Controllers;
use App\Models\Application;
use Illuminate\Http\Request;

class AppliedJobController extends Controller
{
    public function index()
    {
        $applications = Application::with('job.company') // relation
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.pages.candidate.appliedjobs', compact('applications'));
    }
}
