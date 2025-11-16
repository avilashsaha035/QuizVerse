<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function index() {
        return view('backend.question.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        Excel::import(new QuestionsImport, $request->file('file'));

        return back()->with('success', 'Questions imported successfully!');
    }
}
