<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmsItemController extends Controller
{
    public function index()
    {
        return view('lms_item.index');
    }
}
