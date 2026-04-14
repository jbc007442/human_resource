<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Job;
use App\Models\JobQuestion;
use App\Models\JobQuestionOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{

    public function index()
    {
        return view('dashboard.pages.company.job-list');
    }

    public function edit($id)
    {
        $job = Job::with('questions.options')->findOrFail($id);

        return view('dashboard.pages.company.edit-jobs', compact('job'));
    }

    public function data()
    {
        $jobs = Job::where('user_id', Auth::id()) // 🔥 FILTER HERE
            ->latest()
            ->get();

        return response()->json($jobs);
    }

    public function toggleStatus($id)
    {
        $job = Job::findOrFail($id);

        $job->status = $job->status === 'active' ? 'inactive' : 'active';
        $job->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        Job::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        $sheets = Excel::toArray([], $request->file('file'));

        $jobsSheet = $sheets[0] ?? [];

        foreach ($jobsSheet as $index => $row) {

            if ($index === 0) continue; // skip header
            if (empty($row[0])) continue; // title required

            Job::create([
                'user_id' => Auth::id(),

                // ✅ FIXED INDEXES
                'title' => $row[0] ?? null,
                'type' => $row[1] ?? null,
                'location' => $row[2] ?? null,
                'department' => $row[3] ?? null,
                'experience_min' => $row[4] ?? null,
                'experience_max' => $row[5] ?? null,
                'salary' => $row[6] ?? null,
                'description' => $row[7] ?? null,
                'requirements' => $row[8] ?? null,
                'status' => $row[9] ?? 'active',

                'has_test' => false,
                'test_mode' => null,
            ]);
        }

        return back()->with('success', 'Jobs imported successfully 🚀');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            // 🔹 1. CREATE JOB
            $job = Job::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'type' => $request->type,
                'location' => $request->location,
                'department' => $request->department,
                'experience_min' => $request->experience_min,
                'experience_max' => $request->experience_max,
                'salary' => $request->salary,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'has_test' => $request->has_test ? true : false,
                'test_mode' => $request->test_mode,
                'status' => $request->status ?? 'inactive',
            ]);

            // 🔹 2. STORE QUESTIONS
            if ($request->has_test && $request->questions) {

                foreach ($request->questions as $q) {

                    $question = JobQuestion::create([
                        'job_id' => $job->id,
                        'question' => $q['question'],
                        'type' => $q['type'], // IMPORTANT (fixed)
                    ]);

                    // 🔹 3. STORE OPTIONS (ONLY IF OBJECTIVE)
                    if ($q['type'] === 'objective' && isset($q['options'])) {

                        foreach ($q['options'] as $index => $opt) {

                            if (!$opt) continue; // skip empty

                            JobQuestionOption::create([
                                'question_id' => $question->id,
                                'option_text' => $opt,
                                'is_correct' => isset($q['correct']) && $q['correct'] == $index
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Job created successfully 🚀');
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $job = Job::findOrFail($id);

            // 🔹 1. UPDATE JOB
            $job->update([
                'title' => $request->title,
                'type' => $request->type,
                'location' => $request->location,
                'department' => $request->department,
                'experience_min' => $request->experience_min,
                'experience_max' => $request->experience_max,
                'salary' => $request->salary,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'has_test' => $request->has_test ? true : false,
                'test_mode' => $request->test_mode,
                'status' => $request->status ?? 'inactive',
            ]);

            // 🔹 2. DELETE OLD QUESTIONS (simple approach)
            JobQuestionOption::whereIn('question_id', function ($q) use ($id) {
                $q->select('id')->from('job_questions')->where('job_id', $id);
            })->delete();

            JobQuestion::where('job_id', $id)->delete();

            // 🔹 3. INSERT NEW QUESTIONS
            if ($request->has_test && $request->questions) {

                foreach ($request->questions as $q) {

                    $question = JobQuestion::create([
                        'job_id' => $job->id,
                        'question' => $q['question'],
                        'type' => $q['type'],
                    ]);

                    if ($q['type'] === 'objective' && isset($q['options'])) {

                        foreach ($q['options'] as $index => $opt) {

                            if (!$opt) continue;

                            JobQuestionOption::create([
                                'question_id' => $question->id,
                                'option_text' => $opt,
                                'is_correct' => isset($q['correct']) && $q['correct'] == $index
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('edit.jobs', $job->id)
                ->with('success', 'Job updated successfully ✨');
        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
