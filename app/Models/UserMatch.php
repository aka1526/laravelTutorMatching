<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;

    protected $table = 'users_match';
    protected $primaryKey = 'id';

    protected $fillable = [
        'subject_id',
        'user_match_province',
        'user_match_Edlevel',
        'user_match_style',
        'user_match_gender',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tutor() {
        return $this->belongsTo(Tutor::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }

}