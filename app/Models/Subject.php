<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $fillable = ['subject_name'];

    public function course(){
        return $this->belongsTo(Course::class);
    }


    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'teaches');
    }

    
}
