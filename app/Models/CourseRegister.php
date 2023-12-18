<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseRegister extends Model
{
    use HasFactory;

    protected $table = 'course_register';
    protected $primaryKey = 'doc_no';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'doc_no', 'register_date'
        , 'register_month', 'register_year'
        , 'user_id', 'user_name', 'course_id'
        , 'course_name', 'tutor_id'
        , 'tutor_name', 'course_price', 'course_hour'
        , 'payment_img', 'register_status'
        , 'payment_datetime'
    ];


}
