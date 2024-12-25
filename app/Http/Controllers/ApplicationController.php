<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{
    private $user;
    protected $status;
    public function __construct()
    {
        $this->user          = auth()->user();
        $this->status        = config('constants.STATUS');
    }

    public function index()
    {

        $data['applications']  = Application::with('user', 'category', 'country')->get();

        return view('pages.application.listing', $data);
    }
    public function add($id=null)
    {
        
        $data['categories'] = Category::all();
        $data['countries'] = Country::all();
        $data['users'] = User::all();
        $data['user'] = auth()->user();
        $data['client'] =Client::all();
        if($id){
            $data['application'] = Application::find($id);
        }
        return view('pages.application.add', $data);
    }
    public function application_store(Request $request)
    {
        $user = auth()->user();
        $page_name = 'application';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message  = NULL;
            $saved = Application::updateOrCreate(
                ['id' => $request->id ?? null], 
                [
                    'country_id'             => $request->country_id,
                    'category_id'            => $request->category_id,
                    'user_id'                => $request->user_id,
                    'passport_no'            => strtoupper($request->passport_no), // Make passport number uppercase
                    'passport_expiry'        => $request->passport_expiry,
                    'visa_status'            => ucwords($request->visa_status),  // Capitalize the first letter of visa status
                    'visa_expiry_date'       => $request->visa_expiry_date,
                    'visa_refer_tracking_id' => $request->visa_refer_tracking_id,
                    'ds_160'                 => $request->ds_160,
                    'status'                 => $request->status,
                    'created_by'             => $user->id,
                ]
            );
            $message = "Application" . ($request->id ? "Updated" : "Saved") . " Successfully";
                return redirect()->route('application.index')->with('message',$message);
    }
}