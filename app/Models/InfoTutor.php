<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTutor extends Model
{
    use HasFactory;

    protected $table = 'info_tutors';
    protected $primaryKey = 'id';

    protected $fillable = [
        'tutor_id',
        'info_tutor_education',
        'info_tutor_faculty',
        'info_tutor_major',
        'info_tutor_grade',
        'info_tutor_univercity',
        'info_tutor_certi',
        'info_tutor_location',
        'info_tutor_exp',
        
    ];
    

    public function tutors(){
        return $this->belongsTo(Tutor::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
    
    

}


