<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'courses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'course_img',
        'course_name',
        'course_content',
        'course_information',
        'course_time',
        'course_level',
        'course_type',
        'course_target',
        'course_status',
        'subject_id',
        'tutor_id',
    ];

    // public function tutor()
    // {
    //     return $this->belongsTo(Tutor::class);
    // }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'teaches');
    }


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}