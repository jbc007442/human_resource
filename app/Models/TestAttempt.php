<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'mock_test_id',
        'total_questions',
        'correct_answers',
        'score',
        'time_taken',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function test()
    {
        return $this->belongsTo(MockTest::class, 'mock_test_id');
    }
}
