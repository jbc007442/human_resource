<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'resume_id',
        'title',
        'description',
        'sort_order',
    ];

    /**
     * RELATION: Achievement belongs to Resume
     */
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
