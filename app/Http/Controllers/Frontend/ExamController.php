<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function exam() {
        $exams =  Exam::where('is_active', 1)->orderBy('updated_at', 'desc')->paginate(6);
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
}
