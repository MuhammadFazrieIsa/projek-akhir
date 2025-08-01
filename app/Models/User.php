<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'rfid_uid',
        'password',
        'jenis_kelamin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

public function absenTerbaru()
{
    return $this->hasOne(\App\Models\Absen::class, 'rfid_uid', 'rfid_uid')->latestOfMany();
    return $this->hasOne(Absen::class)->latest('tanggal');
}

    public function absen()
    {
        return $this->hasMany(Absen::class, 'rfid_uid', 'rfid_uid');
    }

    public function nilaiKinerja()
    {
        return $this->hasMany(NilaiKinerja::class, 'rfid_uid', 'rfid_uid');
    }

    public function nilaiKehadiran()
    {
        return $this->hasMany(NilaiKehadiran::class, 'rfid_uid', 'rfid_uid');
    }

    public function nilaiKedisiplinan()
    {
        return $this->hasMany(NilaiKedisiplinan::class, 'rfid_uid', 'rfid_uid');
    }

    
}
