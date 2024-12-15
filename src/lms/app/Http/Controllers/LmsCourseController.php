<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmsCourseController extends Controller
{
    public function index()
    {
        return view('lms_course.index');
    }
}
