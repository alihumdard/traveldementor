<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('pages.Appointment.listing', $data);
    }
}
