<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'phone',
        'status',
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

    public function username()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function userupdate()
    {
        return $this->belongsTo(User::class, 'updated_by')->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_by = auth()->id();
        });

        static::updating(function ($user) {
            $user->updated_by = auth()->id();
        });

        static::deleting(function ($user) {
            $user->deleted_by = auth()->id();
            $user->save();
        });
    }
}
