<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_subjects')->withPivot('question_count')->withTimestamps();
    }
}
