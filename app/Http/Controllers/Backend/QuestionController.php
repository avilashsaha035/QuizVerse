<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\QuestionDataTable;

class QuestionController extends Controller
{
    public function index(QuestionDataTable $dataTable) {
        return $dataTable->render('backend.question.index');
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
