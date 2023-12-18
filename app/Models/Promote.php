<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    use HasFactory;

    protected $table = 'promotes';
    protected $primaryKey = 'promote_id';

    protected $fillable = [
        'promote_title',
        'promote_date'
    ];
    
    public function tutors(){
        return $this->belongsTo(Tutor::class, 'id', 'id');
    }

    // public function admin(){
    //     return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    // }
}
