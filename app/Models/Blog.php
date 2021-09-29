<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
     protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'image',
        'user_id',
        'is_active',
    ];

}
