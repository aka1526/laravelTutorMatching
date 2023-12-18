<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class news extends Model
{
    use HasFactory;
    
    
    protected $primaryKey = 'news_id';

    protected $fillable = ["news_title","news_detail","news_tel","news_img","news_status"];

}
