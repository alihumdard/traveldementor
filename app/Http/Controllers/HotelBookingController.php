<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Country;
use App\Models\HotelBooking;
use App\Models\SoftwareStatus;

class HotelBookingController extends Controller
{
    public function add($id = null)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['countries'] = Country::orderBy('name')->get();
        $data['status'] = SoftwareStatus::where('type', 5)->get();
       
        if($user->role=="Staff")
        {
            $data['clients'] = Client::where('staff_id',$user->id)->orderBy('name')->get();
        }
        else
        {
            $data['clients'] = Client::orderBy('name')->get();
        }      
        if ($id) {
            $data['hotelbooking'] = HotelBooking::find($id);
        }
        return view('pages.hotelbooking.add', $data);
    }

    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if($user->role=="Staff")
        {
            $data['clients'] = Client::where('staff_id',$user->id)->get();
            $data['hotel_bookings'] = HotelBooking::with('country', 'client')
            ->whereHas('client', function ($query) use ($user) {
                $query->where('staff_id', $user->id);
            })->get();
        }
        else
        {
            $data['clients'] = Client::orderBy('name')->get();
            $data['hotel_bookings'] = HotelBooking::with('country', 'client')->get();
        }
        return view('pages.hotelbooking.listing', $data);
    }
    public function store(Request $request)
    {     
        $user = auth()->user();
        $page_name = 'hotel_booking';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message = null;
        $saved = HotelBooking::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'application_id'          => $request->application_id,
                'country_id'              => $request->country_id,
                's_date'                  => $request->s_date,
                'e_date'                  => $request->e_date,
                'hotel_cancel_due_date'   => $request->hotel_cancel_due_date,
                'name'                    => $request->name,
                'reservation_id'          => $request->reservation_id,
                'reservation_email'       => $request->reservation_email,
                'status'                  => $request->status,
                'created_by'              => $user->id,
            ]
        );

        $message = "Hotel Booking " . ($request->id ? "Updated" : "Saved") . " Successfully";

        return redirect()->route('hotel.index')->with('message', $message);
    }
    public function hotel_detail_page($id)
    {
        $data['detail_page']=HotelBooking::with('client','country')->find($id);
        return response()->json($data);
    }

    public function delete($id)
    {
        $hotelbooking = HotelBooking::find($id);
        $hotelbooking->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
