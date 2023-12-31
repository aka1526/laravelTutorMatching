<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'web';
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'firstname',
        'lastname',
        'tel',
        'address',
        'img',
        'birthdate',
        'status'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function promotes()
    {
        return $this->hasMany(Promote::class, 'promote_id', 'id');
    }

    public function infotutor()
    {
        //
        return $this->hasOne(InfoTutor::class, 'info_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'comments')->withPivot('content');
    }

    // ------------------------------------------
    public function userMatches()
    {
        return $this->hasOne(UserMatch::class);
    }

}