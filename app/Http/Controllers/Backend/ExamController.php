<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exam.index');
    }

    public function create()
    {
        return view('backend.exam.create');
    }
}
