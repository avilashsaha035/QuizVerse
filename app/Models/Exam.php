<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'exam_type ',
        'duration_minutes ',
        'no_of_ques ',
        'is_shuffling ',
        'pass_marks ',
        'start_date  ',
        'start_time ',
        'end_date  ',
        'end_time ',
        'is_active  ',
        'language ',
        'access_code ',
        'attempts_allowed ',
        'created_by  ',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'exam_subjects')->withPivot('question_count')->withTimestamps();
    }
}
