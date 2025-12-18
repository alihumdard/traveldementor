<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\VfsEmbassy;
use Illuminate\Http\Request;
use App\Models\Alert;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    // public function schedule_index()
    // {
    //     $user = auth()->user();
    //     $data['user'] = $user;
    //     if ($user->role == "Staff") {
    //         $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
    //             ->where('appointment_type', '=', 'scheduled')
    //             ->whereHas('client', function ($query) use ($user) {
    //                 $query->where('staff_id', $user->id);
    //             })
    //             ->get();
    //     } else {
    //         $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
    //             ->where('appointment_type', '=', 'scheduled')
    //             ->get();
    //     }

    //     return view('pages.appointment.schedule.listing', $data);
    // }
    public function schedule_index()
    {
        $user = auth()->user();
        $data['user'] = $user;

        if ($user->role == "Staff") {
            $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
                ->where('appointment_type', '=', 'scheduled')
                ->whereHas('client', function ($query) use ($user) {
                    $query->where('staff_id', $user->id);
                })
                ->orderBy('bio_metric_appointment_date', 'asc') // ⭐ Added sorting
                ->get();
        } else {
            $data['appointments'] = Appointment::with(['client', 'category', 'vfsembassy'])
                ->where('appointment_type', '=', 'scheduled')
                ->orderBy('bio_metric_appointment_date', 'asc') // ⭐ Added sorting
                ->get();
        }

        return view('pages.appointment.schedule.listing', $data);
    }
    public function add($id = null)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['categories'] = Category::all();
        $data['countries'] = Country::all();
        $data['clients'] = Client::all();
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
        $appointment = Appointment::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'application_id'               => $request->application_id,
                'country_id'                   => $request->country_id,
                'vfs_embassy_id'               => $request->vfs_embassy_id,
                'category_id'                  => $request->category_id,
                'no_application'               => $request->no_application,
                'appointment_type'             => 'scheduled',
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

        if ($appointment && $request->bio_metric_appointment_date) {
            $application = Application::with('country', 'client')->find($request->application_id);
            if ($application) {
                Alert::where('appointment_id', $appointment->id)->where('type', 'scheduled_appointment')->delete();

                $appointmentDate = Carbon::parse($request->bio_metric_appointment_date);
                $alertDate = null;

                if ($application->country->code == 'US') {
                    $alertDate = $appointmentDate->copy()->subMonth();
                } else {
                    $alertDate = $appointmentDate->copy()->subDays(3);
                }

                Alert::create([
                    'client_id'      => $application->client->id,
                    'appointment_id' => $appointment->id,
                    'name'           => 'Scheduled Appointment',
                    'email'          => $application->client->email,
                    'email_forward'  => 'n',
                    'type'           => 'scheduled_appointment',
                    'user_id'        => $application->client->staff_id,
                    'title'          => 'Scheduled Appointment Reminder',
                    'url'            => route('schedule.appointment.index'),
                    'body'           => json_encode([
                        'message' => 'You have a scheduled appointment on ' . $appointmentDate->format('M d, Y') . ' for ' . $application->country->name . '.'
                    ]),
                    'message'        => 'Dear ' . $application->client->name . ', This is a reminder for your scheduled appointment on ' . $appointmentDate->format('M d, Y') . ' for ' . $application->country->name . '.',
                    'status'         => 'unseen',
                    'display_date'   => $alertDate,
                    'deleted_at'     => 'n',
                ]);
            }
        }

        $message = "Appointment " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('schedule.appointment.index')->with('message', $message);
    }

    public function schedule_detail_page($id)
    {
        $data['detail_page'] = Appointment::with('client', 'category', 'country', 'vfsembassy')->find($id);
        return response()->json($data);
    }

    public function delete($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            Alert::where('appointment_id', $id)->delete();
            $appointment->delete();
        }
        return redirect()->back()->with('message', 'Successfully Deleted');
    }
}
