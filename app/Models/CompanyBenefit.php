<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyBenefit extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'icon',
    ];

    // 🔗 Relationship: Benefit → Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
