<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmsContentController extends Controller
{
    public function index()
    {
        return view('lms_content.index');
    }
}
