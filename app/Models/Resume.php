<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'address',
        'summary',
        'resume_file',
    ];

    /**
     * RELATION: Resume belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELATION: Resume has many Experiences
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('sort_order');
    }

    /**
     * RELATION: Resume has many Skills
     */
    public function skills()
    {
        return $this->hasMany(Skill::class)->orderBy('sort_order');
    }

    /**
     * RELATION: Resume has many Educations
     */
    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('sort_order');
    }

    /**
     * RELATION: Resume has many Achievements
     */
    public function achievements()
    {
        return $this->hasMany(Achievement::class)->orderBy('sort_order');
    }

    // 🔥 ACCESSORS (Fetch from users table)

    public function getFullNameAttribute()
    {
        return $this->user->name ?? '';
    }

    public function getEmailAttribute()
    {
        return $this->user->email ?? '';
    }

    public function getPhoneAttribute()
    {
        return $this->user->phone ?? '';
    }
}
