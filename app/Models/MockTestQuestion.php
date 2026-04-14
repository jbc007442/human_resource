<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTestQuestion extends Model
{
    protected $fillable = [
        'mock_test_id',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
    ];

    public function mockTest()
    {
        return $this->belongsTo(MockTest::class, 'mock_test_id');
    }
}
