<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAnswer extends Model
{
    protected $fillable = [
        'application_id',
        'question',
        'answer',
        'is_correct',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}