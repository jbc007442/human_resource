<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resume;

class ResumeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔥 Get or create resume + load all relations
        $resume = Resume::with([
            'experiences',
            'skills',
            'educations',
            'achievements'
        ])->firstOrCreate(
            ['user_id' => $user->id],
            [] // empty defaults
        );

        return view('dashboard.pages.candidate.resume', compact('user', 'resume'));
    }

    public function create()
    {
        $user = Auth::user();

        $resume = Resume::with([
            'experiences',
            'skills',
            'educations',
            'achievements'
        ])->firstOrCreate(
            ['user_id' => $user->id],
            []
        );

        return view('dashboard.pages.candidate.addresume', compact('user', 'resume'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // ✅ VALIDATION
        $request->validate([
            'resume_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        // 🔥 GET OR CREATE RESUME
        $resume = Resume::updateOrCreate(
            ['user_id' => $user->id],
            [
                'title' => $request->title,
                'address' => $request->address,
                'summary' => $request->summary,
            ]
        );

        // =========================
        // ✅ FILE UPLOAD
        // =========================
        if ($request->hasFile('resume_file')) {

            // delete old file
            if ($resume->resume_file) {
                Storage::disk('public')->delete($resume->resume_file);
            }

            $resume->update([
                'resume_file' => $request->file('resume_file')->store('resumes', 'public')
            ]);
        }

        // =========================
        // ✅ CLEAR OLD DATA (IMPORTANT)
        // =========================
        $resume->experiences()->delete();
        $resume->skills()->delete();
        $resume->educations()->delete();
        $resume->achievements()->delete();

        // =========================
        // ✅ SAVE EXPERIENCES
        // =========================
        if ($request->company) {
            foreach ($request->company as $i => $company) {

                if (empty($company)) continue; // ✅ skip empty

                $resume->experiences()->create([
                    'company_name' => $company,
                    'job_title' => $request->role[$i] ?? null,
                    'start_date' => $request->from_year[$i] ?? null,
                    'end_date' => $request->to_year[$i] ?? null,
                    'description' => isset($request->responsibilities[$i])
                        ? implode(', ', array_filter($request->responsibilities[$i]))
                        : null,
                    'sort_order' => $i,
                ]);
            }
        }

        // =========================
        // ✅ SAVE SKILLS
        // =========================
        if ($request->skills) {
            foreach ($request->skills as $i => $skill) {
                if (!empty($skill)) {
                    $resume->skills()->create([
                        'skill_name' => $skill,
                        'sort_order' => $i,
                    ]);
                }
            }
        }

        // =========================
        // ✅ SAVE EDUCATION
        // =========================
        if ($request->degree) {
            foreach ($request->degree as $i => $degree) {
                $resume->educations()->create([
                    'degree' => $degree,
                    'institute' => $request->institute[$i] ?? null,
                    'from' => $request->edu_from[$i] ?? null,
                    'to' => $request->edu_to[$i] ?? null,
                    'description' => $request->edu_description[$i] ?? null,
                    'sort_order' => $i,
                ]);
            }
        }

        // =========================
        // ✅ SAVE ACHIEVEMENTS
        // =========================
        if ($request->achievements) {

            // 🔥 convert textarea string into array
            $achievements = array_values(array_filter(
                explode("\n", $request->achievements)
            ));

            foreach ($achievements as $i => $ach) {
                $resume->achievements()->create([
                    'title' => trim($ach),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('dashboard.resume')
            ->with('success', 'Resume updated successfully!');
    }

    public function downloadPdf()
    {
        $user = auth()->user();
        $resume = $user->resume;

        $pdf = Pdf::loadView('dashboard.pages.candidate.resumePDF', compact('user', 'resume'));

        return $pdf->download('resume.pdf');
    }
}
