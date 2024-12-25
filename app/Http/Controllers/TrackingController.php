<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('pages.Tracking.listing', $data);
    }
}
