<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'resume_id',
        'skill_name',
        'sort_order',
    ];

    /**
     * RELATION: Skill belongs to Resume
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
