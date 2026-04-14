<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class WebsiteController extends Controller
{



    public function home(Request $request)
    {
        $query = Job::with('company')
            ->withCount('applications')
            ->where('status', 'active');

        // 🔍 Keyword Search
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                    ->orWhereHas('company', function ($q2) use ($keyword) {
                        $q2->where('company_name', 'like', "%$keyword%");
                    });
            });
        }

        // 📍 Location
        if (!empty($request->location)) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // 🔽 Sorting
        if ($request->sort == 'salary') {
            $query->orderBy('salary', 'desc');
        } else {
            $query->latest();
        }

        $jobs = $query->paginate(10)->withQueryString();

        // ✅ FIX: Load resume with relations
        $resume = null;

        if (auth()->check() && auth()->user()->role === 'jobseeker') {
            $resume = \App\Models\Resume::with([
                'skills',
                'experiences',
                'educations'
            ])->where('user_id', auth()->id())
                ->latest()
                ->first();
        }

        return view('website.home', compact('jobs', 'resume'));
    }
}
