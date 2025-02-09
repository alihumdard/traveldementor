<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Alert;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function add($id = null)
    {
        $data['client'] = $id ? Client::find($id) : new Client();
        $data['role'] = auth()->user()->role;
        $staff = auth()->user()->id;
        if ($data['role'] == "Staff") {
            $data['staffs'] = User::where('id', $staff)->first();
        } else {
            $data['staffs'] = User::where('role', 'Staff')->get();
        }
        return view('pages.client.add', $data);
    }

    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if ($user->role == "Staff") {
            $data['clients'] = Client::where('staff_id', $user->id)->orderBy('name')->get();
        } else {
            $data['clients'] = Client::orderBy('name')->orderBy('name')->get();
        }
        return view('pages.client.listing', $data);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $page_name = 'client';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        // Create or Update the Client
        $client = Client::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'name'         => $request->name,
                'sur_name'     => $request->sur_name,
                'email'        => $request->email,
                'contact_no'   => $request->contact_no,
                'refer_person' => $request->refer_person,
                'dob'          => $request->dob,
                'staff_id'     => $request->staff_id,
                'created_by'   => $user->id,
            ],
        );

        if ($client && $client->dob) {
            $dob = Carbon::parse($client->dob);

            for ($i = 0; $i < 20; $i++) {
                $futureYear = Carbon::now()->year + $i;
                $futureDob = $dob->copy()->year($futureYear);
                $alertDate = $futureDob->subDays(1);

                $existingAlert = Alert::where('client_id', $client->id)
                    ->where('type', 'date_of_birth')
                    ->whereYear('display_date', $futureYear)
                    ->first();

                if (!$existingAlert) {
                    Alert::create([
                        'client_id'     => $client->id,
                        'name'          => $client->name,
                        'email'         => $client->email,
                        'email_forward' => 'n',
                        'type'          => 'date_of_birth',
                        'user_id'       => $client->staff_id,
                        'title'         => 'Date of Birth Alert',
                        'url'           => route('client.index'),
                        'body'          => json_encode('Hello ' . $client->name . ', our records indicate that your date of birth is ' . $dob->format('M d, Y') . '. If this information is incorrect, please update it promptly to ensure accuracy in our system.'),
                        'message'       => 'Dear ' . $client->name . ', your date of birth is recorded as ' . $dob->format('M d, Y') . '. Please verify and update it if needed to avoid any discrepancies in your records.',
                        'status'        => 'unseen',
                        'display_date'  => $alertDate,
                        'deleted_at'    => 'n',
                    ]);
                }
            }
        }

        $message = "Client " . ($request->id ? "Updated" : "Created") . " Successfully";
        return redirect()->route('client.index')->with('message', $message);
    }
    public function client_detail_page($id)
    {
        $data['detail_page'] = Client::find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
