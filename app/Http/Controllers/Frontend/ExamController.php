<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Exam;
use App\Models\userAnswer;
use Illuminate\Http\Request;
use App\Models\ExamAttemptUser;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function exam()
    {
        $exams = Exam::where('is_active', 1)
            ->with(['attempts' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->orderBy('updated_at', 'desc')
            ->paginate(6);

        return view('frontend.exam.all-exam', compact('exams'));
    }

    public function rules($id) {
        $exam = Exam::select('id', 'title', 'description')->findOrFail($id);
        return view('frontend.exam.rules', compact('exam'));
    }

    public function start($id) {
        $exam = Exam::findOrFail($id);
        return view('frontend.exam.exam-start', compact('exam'));
    }

    public function result($id)
    {
        $exam = Exam::with(['questions.options', 'questions.explanation'])->findOrFail($id);

        $attempt = ExamAttemptUser::where('exam_id', $id)
            ->where('user_id', auth()->id())
            ->latest('submitted_at')
            ->firstOrFail();

        // Load all answers for this attempt
        $userAnswers = userAnswer::where('exam_attempt_users_id', $attempt->id)->get()->keyBy('question_id'); // easy lookup by question_id

        return view('frontend.exam.result', compact('exam', 'attempt', 'userAnswers'));
    }
}
