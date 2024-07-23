<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function scopeSearch($query, $search_text)
    {
        return $query->where(function ($query) use ($search_text) {
            $query->whereRaw("LOWER(name) like '%" . mb_strtolower($search_text) . "%'")
                ->orWhereRaw("LOWER(email) like '%" . mb_strtolower($search_text) . "%'");
        });
    }

    public function scopeFilterByEmailVerified($query, $email)
    {
        if ($email == 'true') {
            $query->whereNotNull('email_verified_at');
        }
        return $query;
    }

    public function scopeFilterByPayment($query, $payments) {
        if ($payments == 'true') {
            $query->whereNotNull('payments');
        }
        return $query;
    }
}
