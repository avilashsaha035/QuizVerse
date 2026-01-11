<?php

namespace App\Livewire;

use App\Models\Exam;
use Livewire\Component;

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

    public function submit() {
        // Save attempt, calculate score, etc.
        // Example: ExamAttempt::create([...]);
        return redirect()->route('exam', $this->examId);
    }

    public function render()
    {
        return view('livewire.exam-page');
    }
}
