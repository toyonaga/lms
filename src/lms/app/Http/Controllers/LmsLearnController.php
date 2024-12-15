<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmsLearnController extends Controller
{
    public function index()
    {
        return view('lms_learn.index');
    }
}
