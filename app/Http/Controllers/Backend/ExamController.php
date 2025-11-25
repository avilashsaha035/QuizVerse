<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exam.index');
    }

    public function create()
    {
        $data['subjects'] = Subject::get();
        return view('backend.exam.create', $data);
    }
}
