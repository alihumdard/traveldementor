<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use App\Models\SoftwareStatus;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{
    private $user;
    protected $status;
    public $visa_status;
    public $visa_status_name;
    public $app_status;
    public $app_status_type;

    public function __construct()
    {
        $this->user          = auth()->user();
        $this->status        = config('constants.STATUS');
        $this->visa_status   = config('constants.VISA_STATUS');
        // $this->app_status   = config('constants.APP_STATUS');
        $this->visa_status_name   = config('constants.VISA_STATUS_NAME');
        $this->app_status_type  = config('constants.APP_STATUS_TYPE');
        view()->share([
            'user'        => $this->user,
            'status'      => $this->status,
            'visa_status' => $this->visa_status,
            'visa_status_name' => $this->visa_status_name,
            // 'app_status'  => $this->app_status,
        ]);
    }
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'Staff') {
            $data['app_status']=SoftwareStatus::where('type','application')->get();
            $staff_ids = Client::where('staff_id', $user->id)->pluck('staff_id');
            $data['applications'] = Application::with('client', 'category', 'country')
                ->whereHas('client', function ($query) use ($staff_ids) {
                    $query->whereIn('staff_id', $staff_ids);
                })->get();
        } else {
          
            $data['applications']  = Application::with('client', 'category', 'country')->get();
        }
        // dd($data['applications']);
        return view('pages.application.listing', $data);
    }
    public function add($id = null)
    {
        $user = auth()->user();
        $data['user'] = auth()->user();
        $data['categories'] = Category::where('type','application')->get();
        $data['countries'] = Country::all();
        $data['status'] = SoftwareStatus::where('type',1)->get();

        if($user->role=="Staff")
        {
            $data['status'] = SoftwareStatus::where('type',1)->get();
            $data['users'] = Client::where('staff_id',$user->id)->get();
        }
        else
        {
            $data['users'] = Client::all();
            $data['status'] = SoftwareStatus::where('type',1)->get();
          
        }
        if ($id) {
            $data['application'] = Application::find($id);
            $data['status'] = SoftwareStatus::where('type',1)->get();
        }
        return view('pages.application.add', $data);
    }
    public function add_staff($id = null)
    {

        return view('pages.profile.add_staff');
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
                'passport_no'            => strtoupper($request->passport_no), 
                'passport_expiry'        => $request->passport_expiry,
                'visa_status'            => ucwords($request->visa_status),  
                'visa_expiry_date'       => $request->visa_expiry_date,
                'visa_refer_tracking_id' => $request->visa_refer_tracking_id,
                'ds_160'                 => $request->ds_160,
                'status'                 => $request->status,
                'bank_name'              => $request->bank_name,
                'card_holder_name'       => $request->card_holder_name,
                'created_by'             => $user->id,
            ]
        );
        $message = "Application  " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('application.index')->with('message', $message);
    }
    public function detail_page($id)
    {

        $data['detail_page'] = Application::with('client', 'category', 'country')->find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $application = Application::find($id);
        $application->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
