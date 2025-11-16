<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard() {
        return view('backend.dashboard');
    }

    public function question() {
        return view('backend.question.index');
    }
}
