<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MockTest;
use App\Models\TestAttempt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class MockTestController extends Controller
{
    public function index()
    {
        $tests = MockTest::withCount('questions')->latest()->get();

        return view('website.mocktest', compact('tests'));
    }

    public function create()
    {
        return view('dashboard.pages.user.create-test');
    }

    public function store(Request $request)
    {
        Log::info('Mock test creation started', [
            'request' => $request->all()
        ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.correct_answer' => 'required|in:a,b,c,d',
        ]);

        DB::beginTransaction();

        try {

            // ✅ Create test
            $test = MockTest::create([
                'title' => $request->title,
                'duration' => $request->duration,
                'type' => $request->type,
                'level' => $request->level,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            Log::info('Mock test created', ['test_id' => $test->id]);

            $questionsData = [];

            foreach ($request->questions as $q) {

                if (empty($q['question'])) continue;

                $questionsData[] = [
                    'mock_test_id' => $test->id,
                    'question' => $q['question'],
                    'option_a' => $q['option_a'] ?? null,
                    'option_b' => $q['option_b'] ?? null,
                    'option_c' => $q['option_c'] ?? null,
                    'option_d' => $q['option_d'] ?? null,
                    'correct_answer' => $q['correct_answer'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            Log::info('Prepared questions', [
                'count' => count($questionsData)
            ]);

            if (!empty($questionsData)) {
                DB::table('mock_test_questions')->insert($questionsData);
            }

            DB::commit();

            Log::info('Mock test transaction committed', [
                'test_id' => $test->id
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Test Created Successfully!'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Mock test creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function edit($id)
    {
        $test = MockTest::with('questions')->findOrFail($id);

        return view('dashboard.pages.user.update-test', compact('test'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.correct_answer' => 'required|in:a,b,c,d',
        ]);

        DB::beginTransaction();

        try {

            $test = MockTest::findOrFail($id);

            // ✅ Update test
            $test->update([
                'title' => $request->title,
                'duration' => $request->duration,
                'type' => $request->type,
                'level' => $request->level,
                'icon' => $request->icon,
                'description' => $request->description,
            ]);

            // ❌ delete old questions
            DB::table('mock_test_questions')->where('mock_test_id', $id)->delete();

            // ✅ insert new questions
            $questionsData = [];

            foreach ($request->questions as $q) {

                if (empty($q['question'])) continue;

                $questionsData[] = [
                    'mock_test_id' => $id,
                    'question' => $q['question'],
                    'option_a' => $q['option_a'] ?? null,
                    'option_b' => $q['option_b'] ?? null,
                    'option_c' => $q['option_c'] ?? null,
                    'option_d' => $q['option_d'] ?? null,
                    'correct_answer' => $q['correct_answer'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('mock_test_questions')->insert($questionsData);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Test Updated Successfully!'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Update failed!'
            ], 500);
        }
    }

    public function allTests()
    {
        $tests = MockTest::withCount('questions')->latest()->get();

        return view('dashboard.pages.user.alltest', compact('tests'));
    }







    // for public pages

    public function start($id)
    {
        $test = MockTest::with('questions')->findOrFail($id);

        // ❌ Check if already attempted
        $alreadyAttempted = TestAttempt::where('user_id', auth()->id())
            ->where('mock_test_id', $id)
            ->exists();

        if ($alreadyAttempted) {
            return redirect()->route('mocktest')
                ->with('error', 'You have already attempted this test.');
        }

        return view('website.start-test', compact('test'));
    }

    public function submit(Request $request, $id)
    {
        $test = MockTest::with('questions')->findOrFail($id);

        // ❌ Double protection
        $exists = TestAttempt::where('user_id', auth()->id())
            ->where('mock_test_id', $id)
            ->exists();

        if ($exists) {
            return redirect()->route('mocktest')
                ->with('error', 'You already submitted this test.');
        }

        $answers = $request->answers ?? [];

        $correct = 0;

        foreach ($test->questions as $q) {
            if (isset($answers[$q->id]) && $answers[$q->id] == $q->correct_answer) {
                $correct++;
            }
        }

        $total = $test->questions->count();
        $score = ($total > 0) ? ($correct / $total) * 100 : 0;

        // ✅ Save attempt
        TestAttempt::create([
            'user_id' => auth()->id(),
            'mock_test_id' => $id,
            'total_questions' => $total,
            'correct_answers' => $correct,
            'score' => round($score, 2),
            'time_taken' => $request->time_taken,
        ]);

        return redirect()->route('test.result', $id)
            ->with([
                'score' => round($score, 2),
                'correct' => $correct,
                'total' => $total
            ]);
    }

    public function result($id)
    {
        $attempt = TestAttempt::where('user_id', auth()->id())
            ->where('mock_test_id', $id)
            ->latest()
            ->first();

        if (!$attempt) {
            return redirect()->route('mocktest')
                ->with('error', 'No result found.');
        }

        return view('website.result', compact('attempt'));
    }







    // Question generate by Ai 
    public function generateQuestions(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
            'count' => 'required|integer|min:1|max:50'
        ]);

        try {

            // ✅ Strong prompt (prevents bad JSON)
            $prompt = "
Generate {$request->count} MCQs about {$request->prompt}.

STRICT RULES:
- Return ONLY valid JSON
- No explanation text
- No markdown
- Use double quotes only
- Each question must have exactly 4 options
- correct_answer must be one of: a, b, c, d

FORMAT:
[
  {
    \"question\": \"...\",
    \"options\": {
      \"a\": \"...\",
      \"b\": \"...\",
      \"c\": \"...\",
      \"d\": \"...\"
    },
    \"correct_answer\": \"a\"
  }
]
";

            // ✅ API call with safety
            $response = Http::timeout(30)
                ->retry(2, 1000)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.groq.key'),
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    "model" => config('services.groq.model'),
                    "messages" => [
                        ["role" => "user", "content" => $prompt]
                    ],
                    "temperature" => 0.7,
                ]);

            if (!$response->successful()) {
                return response()->json([
                    'status' => false,
                    'message' => 'AI request failed'
                ], 500);
            }

            $data = $response->json();

            $content = $data['choices'][0]['message']['content'] ?? '';

            // ✅ Extract JSON safely (VERY IMPORTANT)
            preg_match('/\[[\s\S]*\]/', $content, $matches);

            $json = $matches[0] ?? '[]';

            $questions = json_decode($json, true);

            // ✅ fallback if invalid
            if (!is_array($questions)) {
                Log::error('Invalid AI JSON', ['raw' => $content]);

                return response()->json([
                    'status' => false,
                    'message' => 'AI returned invalid format'
                ], 500);
            }

            return response()->json([
                'status' => true,
                'questions' => $questions
            ]);
        } catch (\Exception $e) {

            Log::error('AI Generation Error', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
