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
use App\Models\Alert;
use Carbon\Carbon;

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
        $this->visa_status_name   = config('constants.VISA_STATUS_NAME');
        $this->app_status_type  = config('constants.APP_STATUS_TYPE');
        view()->share([
            'user'        => $this->user,
            'status'      => $this->status,
            'visa_status' => $this->visa_status,
            'visa_status_name' => $this->visa_status_name,
        ]);
    }
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'Staff') {
            $staff_ids = Client::where('staff_id', $user->id)->pluck('staff_id');
            $data['applications'] = Application::with('client', 'category', 'country')
                ->whereHas('client', function ($query) use ($staff_ids) {
                    $query->whereIn('staff_id', $staff_ids);
                })->get();
        } else {
            $data['applications']  = Application::with('client', 'category', 'country')->get();
        }
        return view('pages.application.listing', $data);
    }

    public function add($id = null)
    {
        $user = auth()->user();
        $data['user'] = auth()->user();
        $data['categories'] = Category::where('type', 'VISA')->orderBy('name')->get();
        $data['countries'] = Country::orderBy('name')->get();
        $data['status'] = SoftwareStatus::where('type', 1)->get();

        if ($user->role == "Staff") {
            $data['status'] = SoftwareStatus::where('type', 1)->get();
            $data['users'] = Client::where('staff_id', $user->id)->orderBy('name')->get();
        } else {
            $data['users'] = Client::orderBy('name')->get();
            $data['status'] = SoftwareStatus::where('type', 1)->get();
        }
        if ($id) {
            $data['application'] = Application::find($id);
            $data['status'] = SoftwareStatus::where('type', 1)->get();
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
                'submission_date'        => $request->submission_date,
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

        //passport expiry
        $client = Client::find($request->user_id);
        $alert  = Alert::where('client_id', $client->id)->where('user_id', $client->staff_id)->where('type', 'passport_expiry')->first();
        if (!$alert) {
            if ($client && $request->passport_expiry) {
                $passportExpiry = Carbon::parse($request->passport_expiry);
                $alertDate = $passportExpiry->subMonths(7);
                Alert::create([
                    'client_id'      => $client->id,
                    'name'           => $client->name,
                    'email'          => $client->email,
                    'email_forward'  => 'n',
                    'type'           => 'passport_expiry',
                    'user_id'        => $client->staff_id,
                    'title'          => 'Passport Expiry Alert',
                    'url'            => route('application.index'),
                    'body'           => json_encode([
                        'Your passport will expire on ' . $passportExpiry->format('M d, Y') . '. Please renew it.'
                    ]),
                    'message'        => 'Dear ' . $client->name . ', 
                Your passport is due to expire on ' . $passportExpiry->format('M d, Y') . '. 
                To avoid any inconvenience or travel restrictions, please ensure to renew your passport promptly. 
                Visit the passport renewal office or consult with your travel administrator for further guidance.',
                    'status'         => 'unseen',
                    'display_date'  => $alertDate,
                    'deleted_at'     => 'n',
                ]);
            }
        }

        //visa expiry
        $alert = Alert::where('client_id', $client->id)
            ->where('user_id', $client->staff_id)
            ->where('type', 'visa_expiry_date')
            ->first();
        if (!$alert && $client && $request->visa_expiry_date) {
            $visaExpiry = Carbon::parse($request->visa_expiry_date);
            
            $alertDate = $visaExpiry->copy()->subDays(15);
            // Check if current time is on or after the alert date
            if (Carbon::now()->greaterThanOrEqualTo($alertDate)) {
                Alert::create([
                    'client_id'      => $client->id,
                    'name'           => $client->name,
                    'email'          => $client->email,
                    'email_forward'  => 'n',
                    'type'           => 'visa_expiry_date',
                    'user_id'        => $client->staff_id,
                    'title'          => 'Visa Expiry Alert',
                    'url'            => route('application.index'),
                    'body'           => json_encode([
                        'message' => 'Your Visa will expire on ' . $visaExpiry->format('M d, Y') . '. Please renew it.'
                    ]),
                    'message'        => 'Dear ' . $client->name . ', 
            Your visa is set to expire on ' . $visaExpiry->format('M d, Y') . '. 
            To ensure uninterrupted travel or stay, kindly proceed with the renewal process at your earliest convenience. 
            If assistance is needed, please contact the relevant authority or immigration office.',
                    'status'         => 'unseen',
                    'display_date'   => $alertDate,
                    'deleted_at'     => 'n',
                ]);
            }
        }



        $message = "Application " . ($request->id ? "Updated" : "Saved") . " Successfully";
        return redirect()->route('application.index')->with('message', $message);
    }

    public function detail_page($id)
    {
        $data['detail_page'] = Application::with('client', 'category', 'country')->find($id);
        //    dd($data['detail_page']);
        return response()->json($data);
    }
    public function delete($id)
    {
        $application = Application::find($id);
        $application->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
