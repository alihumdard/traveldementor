<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\TrackingApplication;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class TrackingApplicationController extends Controller
{
    
    private $user;
    protected $status;
    public $visa_status;

    public function __construct()
    {
        $this->user          = auth()->user();
        $this->status        = config('constants.STATUS');
        $this->visa_status   = config('constants.VISA_STATUS');
        view()->share([
            'user'        => $this->user,
            'status'      => $this->status,
            'visa_status' => $this->visa_status,
        ]);
    }
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'Staff') {
            $staff_ids = Client::where('staff_id', $user->id)->pluck('staff_id');
            $data['applications'] = TrackingApplication::with('client', 'category', 'country')
                ->whereHas('client', function ($query) use ($staff_ids) {
                    $query->whereIn('staff_id', $staff_ids);
                })->get();
        } else {
            $data['applications']  = Application::with('client', 'category', 'country')->get();
        }
        return view('pages.tracking_application.listing', $data);
    }
    public function add($id = null)
    {
        $user = auth()->user();
       
        $data['user'] = auth()->user();
        $data['categories'] = Category::all();
        $data['countries'] = Country::all();
        if($user->role=="Staff")
        {
            $data['users'] = Client::where('staff_id',$user->id)->get();
        }
        else{
            $data['users'] = Client::all();  
        }
        if ($id) {
            $data['application'] = TrackingApplication::find($id);
        }
        return view('pages.tracking_application.add', $data);
    }
    // public function add_staff($id = null)
    // {

    //     return view('pages.profile.add_staff');
    // }
    public function application_store(Request $request)
    {
        $user = auth()->user();
        $page_name = 'tracking_application';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message  = NULL;
        $saved = TrackingApplication::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'country_id'             => $request->country_id,
                'user_id'                => $request->user_id,
                'passport_no'            => $request->passport_no, // Make passport number uppercase
                'passport_expiry'        => $request->passport_expiry,
                'visa_status'            => ucwords($request->visa_status),  // Capitalize the first letter of visa status
                'visa_expiry_date'       => $request->visa_expiry_date,
                'visa_refer_tracking_id' => $request->visa_refer_tracking_id,
                'ds_160'                 => $request->ds_160,
                'status'                 => $request->status,
                'created_by'             => $user->id,
            ]
        );
        $message = "Application  " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('tracking.application.index')->with('message', $message);
    }
    public function detail_page($id)
    {
        
        $data['detail_page'] = TrackingApplication::with('client', 'country')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $application = TrackingApplication::find($id);
        $application->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }

}
