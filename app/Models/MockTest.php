<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'type',
        'level',
        'icon',
        'description'
    ];

    public function questions()
    {
        return $this->hasMany(MockTestQuestion::class);
    }
}
