<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    function index(Request $r) {
        
    }

    function items(Request $r) {
        $data['items'] = 0;
        return view('items', $data);
    }
}
