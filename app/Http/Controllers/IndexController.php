<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function professional()
    {
        return view('auth/login');
    }

    public function maternal()
    {
        return view('maternalAuth/login');
    }

}
