<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestAttempt;

class CandidateDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('testAttempts');

        $attempts = $user->testAttempts;

        return view('dashboard.pages.candidate.dashboard', [
            'totalTests' => $attempts->count(),
            'avgScore'   => round($attempts->avg('score') ?? 0, 2),
            'bestScore'  => $attempts->max('score') ?? 0,
            'recentAttempts' => $attempts->sortByDesc('created_at')->take(5),
        ]);
    }
}
