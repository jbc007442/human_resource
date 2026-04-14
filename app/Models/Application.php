<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'resume_id',

        // ✅ Test score (optional)
        'score',

        // 🤖 ATS fields
        'ats_score',
        'ats_skill_score',
        'ats_experience_score',
        'ats_education_score',
        'ats_feedback',
    ];

    // 🔗 Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function answers()
    {
        return $this->hasMany(ApplicationAnswer::class);
    }

    // =====================================================
    // 📊 TEST SCORE (MCQ आधारित)
    // =====================================================

    public function getScoreAttribute()
    {
        if ($this->relationLoaded('answers')) {
            return $this->answers
                ->whereNotNull('is_correct')
                ->where('is_correct', true)
                ->count();
        }

        return $this->answers()
            ->whereNotNull('is_correct')
            ->where('is_correct', true)
            ->count();
    }

    public function getScorePercentageAttribute()
    {
        $total = $this->relationLoaded('answers')
            ? $this->answers->whereNotNull('is_correct')->count()
            : $this->answers()->whereNotNull('is_correct')->count();

        if ($total == 0) return 0;

        return round(($this->score / $total) * 100);
    }

    // =====================================================
    // 🤖 ATS ACCESSORS (NEW)
    // =====================================================

    public function getAtsLabelAttribute()
    {
        if ($this->ats_score >= 80) return 'Excellent Fit';
        if ($this->ats_score >= 60) return 'Good Fit';
        if ($this->ats_score >= 40) return 'Average Fit';

        return 'Low Fit';
    }

    public function getAtsColorAttribute()
    {
        if ($this->ats_score >= 80) return 'green';
        if ($this->ats_score >= 60) return 'blue';
        if ($this->ats_score >= 40) return 'yellow';

        return 'red';
    }

    // =====================================================
    // 🧠 FINAL SCORE (OPTIONAL COMBINED)
    // =====================================================

    public function getFinalScoreAttribute()
    {
        $ats = $this->ats_score ?? 0;
        $test = $this->score_percentage ?? 0;

        // Weight: ATS अधिक important
        return round(($ats * 0.7) + ($test * 0.3));
    }
}