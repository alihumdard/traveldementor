<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InsuranceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if ($user->role == "Staff") {
            $data['insurances'] = Insurance::with(['country', 'client'])
                ->whereHas('client', function ($query) use ($user) {
                    $query->where('staff_id', $user->id);
                })->get();
        } else {
            $data['insurances'] = Insurance::with('country', 'client')->get();
        }
        return view('pages.insurance.listing', $data);
    }
    public function add($id = null)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['countries'] = Country::orderBy('name')->orderBy('name')->get();
        if ($user->role == "Staff") {
            $data['clients'] = Client::where('staff_id', $user->id)->orderBy('name')->get();
        } else {
            $data['clients'] = Client::orderBy('name')->get();
        }
        if ($id) {
            $data['insurance'] = Insurance::find($id);
        }
        return view('pages.insurance.add', $data);
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $page_name = 'insurance';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $insurance = Insurance::updateOrCreate(
            ['id' => $request->id ?? null], 
            [
                'application_id'       => $request->application_id,
                'country_id'           => $request->country_id,
                'plan_type'            => $request->plan_type,
                's_date'               => $request->s_date,
                'e_date'               => $request->e_date, 
                'policy_no'            => $request->policy_no,
                'sale_date'            => $request->sale_date,
                'amount'               => $request->amount,
                'payable_after_40_per' => $request->payable_after_40_per,
                'net_payable'          => $request->net_payable,
                'refund_applied'       => $request->refund_applied,
                'created_by'           => $user->id,
            ]
        );

        if ($insurance && $request->e_date) {
            Alert::where('insurance_id', $insurance->id)->where('type', 'insurance_expiry')->delete();
            $insuranceExpiry = Carbon::parse($request->e_date);
            $alertDate = $insuranceExpiry->copy()->subDays(7);
            
            Alert::create([
                'client_id'     => $insurance->client->id,
                'insurance_id'  => $insurance->id,
                'name'          => 'Insurance', 
                'email'         => $insurance->client->email,
                'email_forward' => 'n',
                'type'          => 'insurance_expiry',
                'user_id'       => $insurance->client->staff_id,
                'title'         => 'Insurance Alert',
                'url'           => route('insurance.index'),
                'body'          => json_encode([
                    'Your insurance will expire on ' . $insuranceExpiry->format('M d, Y') . '. Please renew it.'
                ]),
                'message'       => 'Dear ' . $insurance->client->name . ', 
                 Your insurance is due to expire on ' . $insuranceExpiry->format('M d, Y') . '. 
                 To avoid any inconvenience, please renew your insurance promptly.',
                'status'        => 'unseen',
                'display_date'   => $alertDate,
                'deleted_at'    => 'n',
            ]);
        }

        $message = "Insurance " . ($request->id ? "Updated" : "Created") . " Successfully";

        return redirect()->route('insurance.index')->with('message', $message);
    }
    public function insurance_detail_page($id)
    {
        $data['detail_page'] = Insurance::with('client', 'country')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $insurance = Insurance::find($id);
        if ($insurance) {
            Alert::where('insurance_id', $id)->delete();
            $insurance->delete();
        }
        return redirect()->back()->with('message', 'Successfully Deleted');
    }
}