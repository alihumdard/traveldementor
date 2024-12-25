<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('pages.Application.listing', $data);
    }
    public function add()
    {  $user = auth()->user();
        $data['user'] = $user;
        return view('pages.Application.add', $data);

    }

  
}
