<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\SoftwareStatus;
use App\Models\VfsEmbassy;
use App\Models\Alert;
use Carbon\Carbon;

class PendingController extends Controller
{
    public function pending_index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if ($user->role == "Staff") {
            $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
                ->where('appointment_type', '=', 'pending')
                ->whereHas('client', function ($query) use ($user) {
                    $query->where('staff_id', $user->id);
                })
                ->get();
        } else {
            $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
                ->where('appointment_type', '=', 'pending')
                ->get();
        }
        return view('pages.appointment.pending.listing', $data);
    }
    public function add($id = null)
    {
        // $userIds = Application::pluck('user_id')->unique()->toArray();
        $user = auth()->user();
        $data['user'] = $user;
        $data['categories'] = Category::where('type', '=', 'VISA')->get();
        $data['countries'] = Country::orderBy('name')->get();
        $data['vfsembasses'] = VfsEmbassy::orderBy('name')->get();
        $data['status'] = SoftwareStatus::where('type', 3)->get();
        if ($user->role == "Staff") {
            $data['clients'] = Client::where('staff_id', $user->id)->orderBy('name')->get();
        } else {
            $data['clients'] = Client::orderBy('name')->get();
        }
        if ($id) {
            $data['appointment'] = Appointment::find($id);
        }
        return view('pages.appointment.pending.add', $data);
    }
    public function appointment_store(Request $request)
    {
       
        $user = auth()->user();
        $page_name = 'pending_appointment';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message = null;
        $appointment = Appointment::updateOrCreate(
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
                'bank_name'                    => $request->bank_name,
                'card_holder_name'             => $request->card_holder_name,
                'transaction_date'             => $request->transaction_date,
                'bio_metric_appointment_date'  => $request->bio_metric_appointment_date,
                'appointment_reschedule'       => $request->appointment_reschedule ?? null,
                'appointment_refer_no'         => $request->appointment_refer_no ,
                'status'                       => $request->status,
                'created_by'                   => $user->id,
            ]
        );
        if ($appointment && $request->appointment_type == "scheduled") {
            $appointmentExpiry = Carbon::parse($request->bio_metric_appointment_date);
            // Alert date ko insurance expiry se 1 week pehle set karen
            $alertDate = $appointmentExpiry->copy()->subDays(7);
            // Agar alert already exist nahi karta
            $alert = Alert::where('client_id', $appointment->client->id)
                ->where('user_id', $appointment->client->staff_id)
                ->where('type', 'appointment_expiry')
                ->first();

            if (!$alert) {
                Alert::create([
                    'client_id'     => $appointment->client->id,
                    'name'          => 'Appointment', // Alert ka name
                    'email'         => $appointment->client->email,
                    'email_forward' => 'n',
                    'type'          => 'appointment_expiry', // Alert type
                    'user_id'       => $appointment->client->staff_id,
                    'title'         => 'Appointment Alert', // Alert title
                    'url'           => route('schedule.appointment.index'),
                    'body'          => json_encode([
                        'Your appointment will expire on ' . $appointmentExpiry->format('M d, Y') . '. Please renew it.'
                    ]),
                    'message'       => 'Dear ' . $appointment->client->name . ', 
                     Your appointment is due to expire on ' . $appointmentExpiry->format('M d, Y') . '. 
                     To avoid any inconvenience, please renew your insurance promptly.',
                    'status'        => 'unseen',
                    'display_date'   => $alertDate,
                    'deleted_at'    => 'n',
                ]);
            }
        }



        $message = "Appointment" . ($request->id ? "Updated" : "Saved") . " Successfully";
        if ($request->appointment_type == 'scheduled') {
            return redirect()->route('schedule.appointment.index');
        } else {
            return redirect()->route('pending.appointment.index');
        }
    }
    public function pending_detail_page($id)
    {

        $data['detail_page'] = Appointment::with('client', 'category', 'country', 'vfsembassy')->where('appointment_type', 'pending')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
