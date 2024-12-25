<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('pages.Insurance.listing', $data);
    }
}
