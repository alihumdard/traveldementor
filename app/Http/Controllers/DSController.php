<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\DS160;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DSController extends Controller
{
    public function add($id=null)
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['categories'] = Category::where('type','=','DS160')->orderBy('name')->get();
        if($user->role=="Staff")
        {
            $data['clients']=Client::where('staff_id',$user->id)->orderBy('name')->get();
        }
        else
        {
            $data['clients']=Client::orderBy('name')->get();      
        }
        if ($id) {
            $data['ds160'] = DS160::find($id);
        }
        return view('pages.ds160.add',$data);
    }
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        if($user->role=="Staff")
        {
            $data['ds160']=DS160::with('client','category')
            ->whereHas('client', function ($query) use ($user) {
                $query->where('staff_id', $user->id);
            })->get();
        }
        else
        {
            $data['ds160']=DS160::with('client','category')->get();
        }
       
        return view('pages.ds160.listing', $data);
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $page_name = 'ds_160';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $saved = DS160::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'application_id'       => $request->application_id,
                'category_id'          => $request->category_id,
                'ds_160_create_date'   => $request->ds_160_create_date,
                'ds160'                => $request->ds160,
                'revised_ds160'        => $request->revised_ds160,
                'surname'              => $request->surname,
                'year_of_birth'        => $request->year_of_birth,
                'sec_question'         => $request->sec_question,
                'sec_answer'           => $request->sec_answer,
                'us_travel_doc_email'  => $request->us_travel_doc_email,
                'us_travel_doc_password' => $request->us_travel_doc_password,
                'cgi_ref_no'             => $request->cgi_ref_no,
                'us_travel_doc_updated_password' => $request->us_travel_doc_updated_password,
                'challan_created'      => $request->challan_created,
                'challan_expiry'      => $request->challan_expiry,
                'challan_submitted'    => $request->challan_submitted,
                'payment_mode'         => $request->payment_mode,
                'transaction_date'     => $request->transaction_date,
                'appoint_date'         => $request->appoint_date,
                'appoint_reschedule'   => $request->appoint_reschedule,
                'pick_up_location'     => $request->pick_up_location,
                'premium_delivery'     => $request->premium_delivery,
                'delivery_address'     => $request->delivery_address,
                'created_by'           => $user->id,
            ]
        );
        $message = "DS160 " . ($request->id ? "Updated" : "Created") . " Successfully";
        return redirect()->route('ds.index')->with('message', $message);
    }
    public function ds_detail_page($id)
    {
        $data['detail_page']=DS160::with('client','category')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
    $ds_160=DS160::find($id);
    $ds_160->delete();
    return redirect()->back()->with('message','Successfull Deleted');
    }
}
