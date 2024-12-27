<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DSController extends Controller
{
    public function add()
    {
        return view('pages.ds160.add');

    }
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
       
        return view('pages.ds160.listing', $data);
    }
}
