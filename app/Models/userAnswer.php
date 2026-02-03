<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_attempt_users_id',
        'question_id',
        'selected_option_id',
        'is_correct',
        'answered_at',
    ];
}
