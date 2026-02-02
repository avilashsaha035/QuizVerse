<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;
use App\Models\ExamAttemptUser;

class ExamPage extends Component
{
    public $examId;
    public $exam;
    public $questions = [];
    public $currentIndex = 0; // track current question
    public $answers = [];
    public $timeRemaining; // countdown in seconds

    public function mount($examId) {
        $this->exam = Exam::with('questions.options')->findOrFail($examId);
        $this->questions = $this->exam->questions;
        foreach ($this->questions as $question) {
            if (!array_key_exists($question->id, $this->answers)) {
                $this->answers[$question->id] = null;
            }
        }
        $this->timeRemaining = $this->exam->duration_minutes * 60;
    }

    public function next() {
        if ($this->currentIndex < count($this->questions) - 1) {
            $this->currentIndex++;
        }
    }

    public function prev() {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function selectAnswer($questionId, $optionId) {
        $this->answers[$questionId] = $optionId;
    }

    public function tick() {
        if ($this->timeRemaining > 0) {
            $this->timeRemaining--;
        } else {
            $this->submit();
        }
    }

    public function goTo($index){
        if ($index >= 0 && $index < count($this->questions)) {
            $this->currentIndex = $index;
        }
    }

    public function submit()
    {
        $score = 0;
        foreach ($this->questions as $question) {
            $correctOption = $question->options->where('is_correct', true)->first();
            if ($this->answers[$question->id] == $correctOption->id) {
                $score++;
            }
        }

        // Calculate percentile (example: percentage of correct answers)
        $percentile = ($score / count($this->questions)) * 100;

        // Save attempt without mass assignment
        $attempt = new ExamAttemptUser();
        $attempt->user_id      = auth()->id();
        $attempt->exam_id      = $this->examId;
        $attempt->started_at   = now(); // or track when exam started
        $attempt->submitted_at = now();
        $attempt->score        = $score;
        $attempt->percentile   = $percentile;
        $attempt->save();

        return redirect()->route('exam.result', $this->examId);
    }

    public function render()
    {
        return view('livewire.exam-page');
    }
}
