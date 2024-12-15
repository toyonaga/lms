<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmsLessonController extends Controller
{
    public function index()
    {
        return view('lms_lesson.index');
    }
}
