<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobQuestion extends Model
{
    protected $table = 'job_questions';

    protected $fillable = [
        'job_id',
        'question',
        'type',
    ];

    // ✅ Constants (avoid typo issues)
    const TYPE_SUBJECTIVE = 'subjective';
    const TYPE_OBJECTIVE  = 'objective';

    // 🔗 Belongs to Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // 🔗 One Question → Many Options
    public function options()
    {
        return $this->hasMany(JobQuestionOption::class, 'question_id');
    }

    // ✅ Helper methods (clean usage)
    public function isSubjective()
    {
        return $this->type === self::TYPE_SUBJECTIVE;
    }

    public function isObjective()
    {
        return $this->type === self::TYPE_OBJECTIVE;
    }
}
