<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionExplanation extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'explanation_text',
    ];

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
