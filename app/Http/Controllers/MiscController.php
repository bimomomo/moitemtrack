<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiscController extends Controller
{
    function index(Request $r) {
        if (1==2) {
            
        } else {
            return view('misc/clrgrdanim');
        }
    }
}
