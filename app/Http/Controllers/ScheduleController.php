<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\VfsEmbassy;

class ScheduleController extends Controller
{


    public function schedule_index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])->where('appointment_type', '=', 'schedule')->get();
        return view('pages.appointment.schedule.listing', $data);
    }
    public function add($id = null)
    {
        $userIds = Application::pluck('user_id')->unique()->toArray();
        $user = auth()->user();
        $data['user'] = $user;
        $data['categories'] = Category::all();
        $data['countries'] = Country::all();
        $data['clients'] = Client::whereIn('id', $userIds)->get();
        $data['vfsembasses'] = VfsEmbassy::all();
        if ($id) {
            $data['appointment'] = Appointment::find($id);
        }
        return view('pages.appointment.schedule.add', $data);
    }
    public function appointment_store(Request $request)
    {
        $user = auth()->user();
        $page_name = 'schedule_appointment';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message = null;
        $saved = Appointment::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'application_id'               => $request->application_id,
                'country_id'                   => $request->country_id,
                'vfs_embassy_id'               => $request->vfs_embassy_id,
                'category_id'                  => $request->category_id,
                'no_application'               => $request->no_application,
                'appointment_type'             => $request->appointment_type,
                'applicant_contact'            => $request->applicant_contact,
                'appointment_email'            => $request->appointment_email,
                'appointment_contact_no'       => $request->appointment_contact_no,
                'vfs_appointment_refers'       => $request->vfs_appointment_refers,
                'payment_mode'                 => $request->payment_mode,
                'transaction_date'             => $request->transaction_date,
                'bio_metric_appointment_date'  => $request->bio_metric_appointment_date,
                'appointment_reschedule'       => $request->appointment_reschedule,
                'appointment_refer_no'         => $request->appointment_refer_no,
                'created_by'                   => $user->id,
            ]
        );

        $message = "Appointment " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('schedule.appointment.index')->with('message', $message);
    }

    public function delete($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
