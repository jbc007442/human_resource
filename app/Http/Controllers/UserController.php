<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resume;
use App\Models\Company;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // ✅ 1. Load View (NO heavy data)
    public function index()
    {
        return view('dashboard.pages.user.alluser');
    }

    // ✅ 1. Load View (NO heavy data)

    public function show($id)
    {
        $user = User::findOrFail($id);

        $resume = null;
        $company = null;

        if ($user->role === 'jobseeker') {
            $resume = Resume::with(['skills', 'experiences', 'educations'])
                ->where('user_id', $user->id)
                ->latest()
                ->first();
        }

        if ($user->role === 'company') {
            $company = Company::where('user_id', $user->id)->first();
        }

        return view('dashboard.pages.user.userbyId', compact('user', 'resume', 'company'));
    }

    // ✅ 2. JSON Data (for AJAX)
    public function getUsersJson()
    {
        $users = User::whereIn('role', ['jobseeker', 'company'])
            ->select('id', 'name', 'email', 'phone', 'role', 'is_active') // ⚡ optimized
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users,
            'message' => 'User status updated successfully!'
        ]);
    }

    // ✅ 3. Toggle Status
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User status updated successfully',
            'is_active' => $user->is_active
        ]);
    }

    
}
