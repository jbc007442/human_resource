<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // ✅ IMPORTANT (fix)
    protected $table = 'job_posts';

    protected $fillable = [
        'user_id', // ✅ ADD THIS
        'title',
        'type',
        'location',
        'department',
        'experience_min',
        'experience_max',
        'salary',
        'description',
        'requirements',
        'has_test',
        'test_mode',
        'status'
    ];

    // 🔗 One Job → Many Questions
    public function questions()
    {
        return $this->hasMany(JobQuestion::class);
    }

    // 🔗 Job → Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'user_id', 'user_id');
    }

    // 🔗 Job → Applications
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
