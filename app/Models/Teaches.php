<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaches extends Model
{
    use HasFactory;

    protected $table = 'teaches';
    protected $primaryKey = 'id';


    protected $fillable = [
        'tutor_id',
        'course_id',
        
    ];


    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
