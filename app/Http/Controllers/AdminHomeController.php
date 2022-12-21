<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('backend.home.index', [
            'title' => 'Home'
        ]);
    }
}
