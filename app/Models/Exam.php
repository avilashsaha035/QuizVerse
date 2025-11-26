<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'exam_subjects')->withPivot('question_count')->withTimestamps();
    }
}
