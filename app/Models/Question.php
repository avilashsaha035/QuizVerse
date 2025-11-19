<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

     protected $fillable = [
        'question_text',
        'subject_id',
        'exam_type',
        'language',
        'created_by',
    ];
}
