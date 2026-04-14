<?php

namespace App\Models;

use App\Models\TestAttempt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'is_active', // ✅ ADD THIS
    ];

    /**
     * Default values
     */
    protected $attributes = [
        'is_active' => false, // ✅ ADD THIS (default inactive)
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean', // ✅ ADD THIS
        ];
    }

    /**
     * Helper: check active status
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Helper: check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     *  Helper: check if user is jobseeker
     */
    public function isJobseeker()
    {
        return $this->role === 'jobseeker';
    }

    /**
     *  Helper: check if user is company
     */    public function isCompany()
    {
        return $this->role === 'company';
    }

    // ===============================
    // 🔥 RESUME RELATION (IMPORTANT)
    // ===============================

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    // ===============================
    // 🔥 TEST ATTEMPTS RELATION
    // ===============================
    public function testAttempts()
    {
        return $this->hasMany(TestAttempt::class);
    }

    // ===============================
    // 🔥 COMPANY here
    // ===============================
    public function company()
    {
        return $this->hasOne(\App\Models\Company::class);
    }


    // ===============================
    // 🔥 PAYMENT here
    // ===============================
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Check premium access
    public function isPremium()
    {
        return $this->is_premium &&
            ($this->premium_expires_at == null || $this->premium_expires_at > now());
    }

    // Get redirect route based on role
    public function getRedirectRoute(): string
    {
        return match ($this->role) {
            'admin' => route('dashboard'),
            'company' => route('company.overview'),
            'jobseeker' => route('candidate.dashboard'),
            default => route('home'),
        };
    }
}
