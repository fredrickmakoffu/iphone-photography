<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonsWatched extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'user_id',
        'watched',
    ];

    protected $casts = [
        'watched' => 'boolean',
    ];

    protected $table = 'lessons_watched';
}
