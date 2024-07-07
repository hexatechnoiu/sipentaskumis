<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(
            Kandidat::class,
            Vote::class,
            'user_id',
            'id',
            'id',
            'kandidat_id'
        );
    }

    public function voteStatus()
    {
        if ($this->isAdmin()) {
            return 'Tidak perlu vote';
        }

        return $this->vote->count() > 0 ? 'Sudah' : 'Belum';
    }

    public function isAdmin()
    {
        return $this->role == 'Admin';
    }
}
