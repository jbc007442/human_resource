<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'payment_id',
        'plan_name',
        'amount',
        'status',
        'paid_at'
    ];

    // 🔗 Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
