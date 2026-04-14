<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'resume_id',
        'company_name',
        'job_title',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * RELATION: Experience belongs to Resume
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
