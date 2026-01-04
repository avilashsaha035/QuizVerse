<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function exam() {
        $exams =  Exam::where('is_active', 1)->orderBy('updated_at', 'desc')->paginate(12);
        return view('frontend.exam.all-exam', compact('exams'));
    }
}
