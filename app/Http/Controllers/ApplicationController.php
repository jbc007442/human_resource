<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobQuestion;
use App\Models\Application;
use App\Models\Resume;
use App\Models\ApplicationAnswer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ApplicationController extends Controller
{
    // 🔹 Show Apply Page
    public function create(Request $request, Job $job)
    {
        if (auth()->user()->role !== 'jobseeker') {
            abort(403);
        }

        $userId = auth()->id();

        // ✅ Load resume
        $resume = Resume::with(['skills', 'experiences', 'educations'])
            ->where('user_id', $userId)
            ->latest()
            ->first();

        // ✅ Check if already applied
        $alreadyApplied = Application::where('user_id', $userId)
            ->where('job_id', $job->id)
            ->exists();

        // ✅ Load questions
        $questions = collect();

        if ($job->has_test) {
            $questions = $job->questions()->with('options')->get();
        }

        // ✅ Step detection
        $step = (int) $request->get('step', 1);

        // =========================
        // 🔒 FLOW CONTROL
        // =========================

        // If already applied → force step 1
        if ($alreadyApplied) {
            $step = 1;
        }

        // If no test → always step 1
        if (!$job->has_test || $questions->isEmpty()) {
            $step = 1;
        }

        // Prevent invalid step
        if (!in_array($step, [1, 2])) {
            $step = 1;
        }

        return view('website.apply', compact(
            'job',
            'resume',
            'questions',
            'step',
            'alreadyApplied'
        ));
    }


    // 🔹 Store Application

    public function store(Request $request, Job $job)
    {
        if (auth()->user()->role !== 'jobseeker') {
            abort(403);
        }

        $userId = auth()->id();

        // Prevent duplicate
        if (Application::where('user_id', $userId)->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'You already applied!');
        }

        $resume = Resume::with(['skills', 'experiences', 'educations'])
            ->where('user_id', $userId)
            ->latest()
            ->first();

        if (!$resume) {
            return back()->with('error', 'Please create your resume first!');
        }

        // ❗ STRICT MODE VALIDATION
        if ($job->has_test && $job->test_mode === 'strict') {
            if (!$request->has('answers')) {
                return back()->with('error', 'You must complete the test before applying!');
            }
        }

        // ✅ Create application
        $application = Application::create([
            'user_id' => $userId,
            'job_id' => $job->id,
            'resume_id' => $resume->id,
        ]);

        // =====================================================
        // 🤖 ATS AI CALL (Groq)
        // =====================================================

        try {

            // =====================================================
            // 🧹 PREPARE CLEAN DATA
            // =====================================================

            $skills = $resume->skills->pluck('skill_name')->filter()->join(', ');
            $experience = $resume->experiences
                ->map(fn($exp) => ($exp->job_title ?? $exp->role) . ' at ' . ($exp->company_name ?? ''))
                ->filter()
                ->join(', ');
            $education = $resume->educations->pluck('degree')->filter()->join(', ');

            // fallback (important)
            $skills = $skills ?: 'No skills provided';
            $experience = $experience ?: 'No experience provided';
            $education = $education ?: 'No education provided';

            // =====================================================
            // 🧠 PROMPT
            // =====================================================

            $prompt = "
    You are an advanced ATS (Applicant Tracking System).

    Evaluate candidate fit strictly.

    Rules:
    - Be realistic and strict
    - Penalize missing skills
    - Do not give high score easily

    Return STRICT JSON:

    {
      \"match_score\": number (0-100),
      \"breakdown\": {
        \"skills\": number,
        \"experience\": number,
        \"education\": number
      },
      \"feedback\": \"short professional explanation\"
    }

    Job Title: {$job->title}
    Job Description: {$job->description}

    Candidate Skills: {$skills}
    Experience: {$experience}
    Education: {$education}
    ";

            // =====================================================
            // 📤 LOG REQUEST (optional but useful)
            // =====================================================

            Log::info('ATS Request', [
                'user_id' => $userId,
                'job_id' => $job->id,
                'skills' => $skills,
                'experience' => $experience,
                'education' => $education,
            ]);

            // =====================================================
            // 🚀 API CALL
            // =====================================================

            $response = Http::timeout(20)->withHeaders([
                'Authorization' => 'Bearer ' . config('services.groq.key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                "model" => "llama-3.3-70b-versatile",
                "messages" => [
                    ["role" => "user", "content" => $prompt]
                ],
                "temperature" => 0.2
            ]);

            // =====================================================
            // 📥 RESPONSE
            // =====================================================

            if (!$response->successful()) {
                Log::error('ATS API Failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return;
            }

            $content = $response['choices'][0]['message']['content'] ?? '{}';

            // clean markdown json
            $content = trim($content);
            $content = preg_replace('/```json|```/', '', $content);
            $content = trim($content);

            Log::info('ATS Raw Response', ['content' => $content]);

            // remove markdown if exists
            $content = trim($content);
            $content = preg_replace('/```json|```/', '', $content);

            // decode directly
            $result = json_decode($content, true);

            Log::info('Parsed ATS Result', $result);

            // ❌ INVALID JSON HANDLING
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('ATS Invalid JSON', [
                    'error' => json_last_error_msg(),
                    'content' => $content
                ]);
                return;
            }

            // 🛑 CHECK IF FEEDBACK MISSING
            if (!isset($result['feedback'])) {
                Log::error('ATS Feedback Missing', [
                    'parsed_result' => $result,
                    'raw_content' => $content
                ]);
            }

            // 💾 SAVE ATS DATA (SAFE SAVE)
            $application->update([
                'ats_score' => data_get($result, 'match_score', 0),
                'ats_skill_score' => data_get($result, 'breakdown.skills', 0),
                'ats_experience_score' => data_get($result, 'breakdown.experience', 0),
                'ats_education_score' => data_get($result, 'breakdown.education', 0),
                'ats_feedback' => data_get($result, 'feedback', 'No feedback generated'),
            ]);

           

            Log::info('ATS Saved Successfully', [
                'application_id' => $application->id,
                'score' => $result['match_score'] ?? 0
            ]);

            // =====================================================
            // 🎯 AUTO SHORTLIST
            // =====================================================

            if (($result['match_score'] ?? 0) >= 70) {
                $application->update(['status' => 'shortlisted']);

                Log::info('Candidate Shortlisted', [
                    'application_id' => $application->id
                ]);
            }
        } catch (\Exception $e) {

            Log::error('ATS Exception', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        }

        // =====================================================
        // 📝 Save Answers (Existing logic)
        // =====================================================

        // if ($job->has_test && $request->answers) {

        //     foreach ($request->answers as $index => $answer) {

        //         $question = $job->questions[$index] ?? null;

        //         if (!$question) continue;

        //         $isCorrect = null;

        //         if ($question->type === 'objective') {
        //             $correct = $question->options->where('is_correct', true)->first();

        //             $isCorrect = ($correct && $answer == $correct->option_text);
        //         }

        //         ApplicationAnswer::create([
        //             'application_id' => $application->id,
        //             'question' => $question->question,
        //             'answer' => $answer,
        //             'is_correct' => $isCorrect,
        //         ]);
        //     }
        // }

        if ($job->has_test && $request->answers) {

            foreach ($request->answers as $index => $answer) {

                $question = $job->questions[$index] ?? null;

                if (!$question) continue;

                $isCorrect = null;

                // ✅ Check correct answer (only for objective)
                if ($question->type === 'objective') {
                    $correct = $question->options->where('is_correct', true)->first();

                    $isCorrect = ($correct && $answer == $correct->option_text);
                }

                ApplicationAnswer::create([
                    'application_id' => $application->id,
                    'question' => $question->question,
                    'answer' => $answer,
                    'is_correct' => $isCorrect,
                ]);
            }

            // ============================================
            // ✅ AUTO CALCULATE SCORE (IMPORTANT)
            // ============================================

            $totalQuestions = ApplicationAnswer::where('application_id', $application->id)
                ->whereNotNull('is_correct')
                ->count();

            $correctAnswers = ApplicationAnswer::where('application_id', $application->id)
                ->where('is_correct', true)
                ->count();

            $percentage = $totalQuestions > 0
                ? round(($correctAnswers / $totalQuestions) * 100)
                : 0;

            // ✅ Save score in applications table
            $application->update([
                'score' => $percentage
            ]);
        }

        return back()->with('success', 'Applied successfully 🚀');
    }
}
