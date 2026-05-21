<?php

namespace App\Models;

use Carbon\Carbon;
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
        'exam_type',
        'duration_minutes',
        'no_of_ques',
        'is_shuffling',
        'pass_marks',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'is_active',
        'language',
        'access_code',
        'attempts_allowed',
        'created_by',
    ];

    public function getStartDatetimeAttribute()
{
    return Carbon::parse($this->start_date . ' ' . $this->start_time);
}

public function getEndDatetimeAttribute()
{
    return Carbon::parse($this->end_date . ' ' . $this->end_time);
}

public function getIsActiveNowAttribute()
{
    $now = Carbon::now();
    return $now->greaterThanOrEqualTo($this->start_datetime)
        && $now->lessThanOrEqualTo($this->end_datetime);
}

public function getHasStartedAttribute()
{
    return Carbon::now()->greaterThanOrEqualTo($this->start_datetime);
}

public function getHasEndedAttribute()
{
    return Carbon::now()->greaterThan($this->end_datetime);
}

public function getFormattedStartDateAttribute()
{
    return Carbon::parse($this->start_date)->format('d M, Y');
}

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'exam_subjects')->withPivot('question_count')->withTimestamps();
    }

    public function questions() {
        return $this->belongsToMany(Question::class, 'exam_questions')->withPivot('order')->withTimestamps();
    }

    public function attempts() {
        return $this->hasMany(ExamAttemptUser::class);
    }

    public function lastAttempt() {
        return $this->hasOne(ExamAttemptUser::class)->latest('submitted_at');
    }
}
