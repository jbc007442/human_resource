<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'ceo',
        'about',
        'logo',
        'founded',
        'size',
        'industry',
        'revenue',
        'hq',
        'website',
    ];

    // 🔗 Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relationship with Job (via user_id)
    public function jobs()
    {
        return $this->hasMany(Job::class, 'user_id', 'user_id');
    }

    // 🔥 NEW: Company → Benefits
    public function benefits()
    {
        return $this->hasMany(CompanyBenefit::class);
    }
}
