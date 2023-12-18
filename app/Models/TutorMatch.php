<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorMatch extends Model
{
    use HasFactory;

    protected $table = 'tutors_match';
    protected $primaryKey = 'id';
    protected $fillable = [
        'subject_id',
        'tutor_match_province',
        'tutor_match_Edlevel',
        'tutor_match_style',
        'tutor_match_gender',
        'tutor_id'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}
