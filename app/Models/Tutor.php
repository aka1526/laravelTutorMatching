<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;



class Tutor extends Authenticatable
{

    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'tutor';
    protected $table = 'tutors';
    protected $primaryKey = 'id';


    protected $fillable = [
        'tutor_name',
        'email',
        'is_tutor',
        'tutor_firstname',
        'tutor_lastname',
        'password',
        'gender',
        'file',
        'tutor_img',
        'tutor_tel',
        'tutor_address',
        'tutor_birthdate',
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
        return $this->hasMany(Promote::class);
    }


    public function infotutor()
    {
        //
        return $this->hasOne(InfoTutor::class);
    }

    // ---------เชื่อ one to many กับ course----------------
    // public function courses()
    // {
    //     return $this->hasMany(Course::class);
    // }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teaches');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'comments')->withPivot('content');
    }

    // --------------------------------------------------------

    public function tutormatchs()
    {
        return $this->hasOne(TutorMatch::class);
    }


    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'teaches');
    }

    public function teaches()
    {
        return $this->hasMany(Teaches::class);
    }

}