<?php

namespace App\Models;

use App\Models\Option;
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

    public function exams() {
        return $this->belongsToMany(Exam::class, 'exam_questions')->withPivot('order')->withTimestamps();
    }
    public function options() {
        return $this->hasMany(Option::class);
    }
}
