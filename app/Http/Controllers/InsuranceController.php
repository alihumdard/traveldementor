<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if($user->role=="Staff")
        {
            $data['insurances'] = Insurance::with(['country', 'client'])
                ->whereHas('client', function ($query) use ($user) {
                    $query->where('staff_id', $user->id);
                })->get();
        }
        else{
            $data['insurances']=Insurance::with('country','client')->get();
        }
        return view('pages.insurance.listing', $data);
    }
    public function add($id=null)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['countries'] = Country::all();
        if($user->role=="Staff")
        {
            $data['clients'] = Client::where('staff_id',$user->id)->get();
        }
        else
        {
            $data['clients'] = Client::all();
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

        // Save or update the insurance record
        $insurance = Insurance::updateOrCreate(
            ['id' => $request->id ?? null], // Match by ID if provided
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

        // Generate the success message
        $message = "Insurance " . ($request->id ? "Updated" : "Created") . " Successfully";

        // Redirect back with a success message
        return redirect()->route('insurance.index')->with('message', $message);
    }
    public function insurance_detail_page($id)
    {
        $data['detail_page'] = Insurance::with('client','country')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
    $insurance=Insurance::find($id);
    $insurance->delete();
    return redirect()->back()->with('message','Successfull Deleted');
    }
}
