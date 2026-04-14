<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQuestionOption extends Model
{

    protected $table = 'job_question_options';

    
    protected $fillable = [
        'question_id',
        'option_text',
        'is_correct'
    ];

    // 🔗 Belongs to Question
    public function question()
    {
        return $this->belongsTo(JobQuestion::class, 'question_id');
    }
}
