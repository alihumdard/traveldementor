<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelBookingController extends Controller
{
    public function add()
    {
        return view('pages.hotelbooking.add');

    }
    
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
       
        return view('pages.hotelbooking.listing', $data);
    }
}
