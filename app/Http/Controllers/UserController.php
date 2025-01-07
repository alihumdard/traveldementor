<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Application;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Client;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\ConnectionException;
use App\Models\User;
use App\Models\Currency;
use App\Models\Location;
use App\Models\VfsEmbassy;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class UserController extends Controller
{
    private $user;
    protected $status;
    protected $currencyTypes;
    protected $locationType;

    public function __construct()
    {
        $this->user          = auth()->user();
        $this->status        = config('constants.STATUS');
        $this->currencyTypes = config('constants.CURRENCY_TYPES');
        $this->locationType  = config('constants.LOCATION_TYPES');
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // User roles: 1 for Super Admin, 2 for Admin, 3 for User
            if (isset($user->role) && $user->role == user_roles('1')) {
                $tot_apps = 0;
                $staffs = 0;
                $total_schd_apps = 0;
                $total_pend_apps = 0;
                $active_users = 0;

                $active_users = Client::count();
                $total_pend_apps = Appointment::where('appointment_type', 'pending')->count();
                $total_schd_apps = Appointment::where('appointment_type', 'schedule')->count();
                $staffs = User::where('role', 'Staff')->count();
                $tot_apps = Application::count();
                return view('pages.dashbords.super_admin', compact('user', 'tot_apps', 'staffs', 'total_schd_apps', 'total_pend_apps', 'active_users'));
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                dd($user->role);
            } else if (isset($user->role) && $user->role == user_roles('3')) {
                dd($user->role);
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function staff()
    {
        $user = auth()->user();
        $page_name = 'staff';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $data['user'] = auth()->user();
        $data['add_as_user'] = user_roles('2');
        if (isset($user->role) && $user->role == user_roles('1')) {
            $data['staffs'] = User::where(['role' => user_roles('2')])->latest('id')->get()->toArray();
        }
        return view('pages.profile.staff', $data);
    }
    public function staff_detail_page($id)
    {

        $data['detail_page'] = User::where('role', 'Staff')->find($id);
        return response()->json($data);
    }
    public function users()
    {
        $user = auth()->user();
        $page_name = 'users';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        if (isset($user->role) && $user->role == user_roles('1')) {
            $users = User::join('users as staff', 'users.staff_id', '=', 'staff.id')
                ->where(['users.role' => user_roles('3'), 'users.staff_id' => $user->id])
                ->select('users.*', 'staff.name as staff_name', 'staff.user_pic as staff_pic', 'staff.email as staff_email')
                ->orderBy('users.id', 'desc')
                ->get()
                ->toArray();
            $staffs_list = User::where(['role' => user_roles('2'), 'staff_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            return view('pages.profile.users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3'), 'staffs_list' => $staffs_list]);
        } else {
            $users = User::where(['role' => user_roles('3'), 'staff_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            return view('pages.profile.users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3')]);
        }
    }
    public function add($id = null)
    {
        if ($id) {

            $data['staff'] = User::find($id);
            return view('pages.profile.add_staff', $data);
        }
        return view('pages.profile.add_staff');
    }
    public function store(Request $request)
    {

        $admin = auth()->user();
        $page_name = 'staff';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $message = null;
        $saved = User::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'password'        => Hash::make($request->password),
                'sadmin_id'       => $admin->id,
                'role'            => $request->role,
                'created_by'      => $admin->id,
            ]
        );

        $message = "Staff  " . ($request->id ? "Updated" : "Saved") . " Successfully";

        return redirect()->route('staff')->with('message', $message);
    }
    public function delete($id)
    {
        $staff = User::find($id);
        $staff->delete();
        return redirect()->back()->with('message', 'Successful Deleted');
    }
    public function currencies(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'currencies';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $currency = NULL;
        $message  = NULL;
        Session::forget('msg');
        if ($request->action == 'edit') {
            $currency = Currency::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Currency::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name'      => ucwords($request->name),
                    'code'      => strtoupper($request->code),
                    'type'      => $request->type,
                    'created_by' => $user->id,
                    'sadmin_id' =>  $user->id,
                ]
            );
            $message = "Currency " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            Currency::where('id', $request->id)->update(['status' => $this->status['Deleted']]);
            $message = "Currency has been deleted Successfully";
            Session::flash('msg', $message);
        }

        $currencies = Currency::where(['sadmin_id' => $user->id, 'status' => $this->status['Active']])->latest('id')->get()->toArray();
        return view('pages.components.currencies', ['user' => $user, 'currency' => $currency, 'data' => $currencies, 'types' => $this->currencyTypes]);
    }
    public function vfs_embassy(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'vfs';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $vfs = NULL;
        $message  = NULL;
        Session::forget('msg');
        if ($request->action == 'save') {
            $request->validate([
                'name' => [
                    'required',
                    'max:60',
                    Rule::unique('vfs_embassies', 'name')->where(function ($query) {
                        return $query->where('status', '!=', 3);
                    })->ignore($request->id),
                ],
            ]);
        }

        if ($request->action == 'edit') {
            $vfs = VfsEmbassy::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = VfsEmbassy::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name'        => ucwords($request->name),
                    'status'      => $this->status['Active'],
                    'created_by'  => $user->id,
                ]
            );
            $message = "VFS " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            VfsEmbassy::where('id', $request->id)->update(['status' => $this->status['Deleted']]);
            $message = "VFS has been deleted Successfully";
            Session::flash('msg', $message);
        }
        $vfs_embassies = VfsEmbassy::where(['status' => $this->status['Active']])->latest('id')->get()->toArray();
        return view('pages.components.vfs_embassy', ['user' => $user, 'vfs' => $vfs, 'data' => $vfs_embassies]);
    }
    public function categories(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'categories';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $category = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'save') {
            $request->validate([
                'name' => [
                    'required',
                    'max:60',
                    Rule::unique('categories', 'name')->where(function ($query) {
                        return $query->where('status', '!=', 3);
                    })->ignore($request->id),
                ],
            ]);
        }
        if ($request->action == 'edit') {
            $category = Category::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Category::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'type' => $request->type,
                    'status' => $this->status['Active'],
                    'created_by' => $user->id,
                ]
            );
            $message = "Category" . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            $deleted = Category::where('id', $request->id)->update(['status' => $this->status['Deleted']]);
            $message = "Category has been deleted Successfully";
            Session::flash('msg', $message);
        }
        $categories = Category::where(['status' => $this->status['Active']])->latest('id')->get()->toArray();
        $data = ['user' => $user, 'category' => $category, 'data' => $categories];

        return view('pages.components.categories', $data);
    }
    public function countries(REQUEST $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $page_name = 'countries';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $country = NULL;
        $message  = NULL;
        Session::forget('msg');
        if ($request->action == 'save') {
            $request->validate([
                'name' => [
                    'required',
                    'max:60',
                    Rule::unique('countries', 'name')->where(function ($query) {
                        return $query->where('status', '!=', 3);
                    })->ignore($request->id),
                ],
            ]);
        }

        if ($request->action == 'edit') {
            $country = Country::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Country::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'status' => $this->status['Active'],
                    'code' => $request->code,
                    'created_by' => $user->id,
                ]
            );
            $message = "Country" . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            $deleted = Country::where('id', $request->id)->update(['status' => $this->status['Deleted']]);
            $message = "Country has been deleted Successfully";
            Session::flash('msg', $message);
        }
        $countries = Country::where(['status' => $this->status['Active']])->latest('id')->get()->toArray();
        $data = ['user' => $user, 'country' => $country, 'data' => $countries];
        return view('pages.components.countries', $data);
    }
    public function locations(REQUEST $request)
    {
        $user = auth()->user();
        $page_name = 'locations';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $location = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'edit') {
            $location = Location::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Location::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'code' => strtoupper($request->code),
                    'type' => $request->type,
                    'sadmin_id' => $user->id,
                    'created_by' => $user->id,
                ]
            );
            $message = "Location " . ($request->id ? "Updated" : "Saved") . " Successfully";
            Session::flash('msg', $message);
        } else if ($request->action == 'dell') {
            $deleted = Location::where('id', $request->id)->update(['status' => $this->status['Deleted']]);
            $message = "Location has been deleted Successfully";
            Session::flash('msg', $message);
        }

        $locations = Location::where(['sadmin_id' => $user->id, 'status' => $this->status['Active']])->latest('id')->get()->toArray();
        $data = ['user' => $user, 'location' => $location, 'data' => $locations, 'types' => $this->locationType];
        return view('pages.components.locations', $data);
    }

    public function settings(Request $request, $user_id = null)
    {
        $user = $user_id ? User::findOrFail($user_id) : auth()->user();
        $page_name = 'settings';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $user->name = $request->name ?? $user->name;
        $user->phone = $request->phone ?? $user->phone;
        $user->address = $request->address ?? $user->address;
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        if ($request->address ||  $request->phone || $request->name) {
            $user->save();
            return redirect()->back()->with('message', 'Successful updated');
        }
        return view('pages.profile.settings', ['user' => $user]);
    }

    public function add_blank(Request $request)
    {
        $user = auth()->user();
        $page_name = 'add_quotation';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $data['user'] = $user;
        $data['duplicate_qoute'] = NULL;
        $data += $this->getCLS(1);

        if ($request->has('id')) {
            $data['duplicate_qoute'] = $request->duplicate_qoute ?? NULL;
            $quotation = Quotation::find($request->id);
            $data['data'] = $quotation->toArray();

            if (isset($user->role) && ($user->role == user_roles('1'))) {
                $data['sadmin_id']   = $user->id;
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
                $data['users_list']  = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $quotation->admin_id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('2'))) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list'] = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        } else {
            if (isset($user->role) && $user->role == user_roles('1')) {
                $data['sadmin_id']   = $user->id;
                $data['users_list']  = [];
                $data['admins_list'] = User::where(['role' => user_roles('2'), 'status' => active_users(), 'sadmin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && $user->role == user_roles('2')) {
                $data['sadmin_id']   = $user->sadmin_id;
                $data['users_list']  = User::where(['role' => user_roles('3'), 'status' => active_users(), 'admin_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();
            } else if (isset($user->role) && ($user->role == user_roles('3'))) {
                $data['sadmin_id']   = $user->sadmin_id;
            }
        }

        return view('pages.components.blank_temp', $data);
    }
    public function blank_temp()
    {
        $user = auth()->user();
        $data['user'] = $user;
        // $data['services']   = Service::select('id', 'title')->where(['type' => $this->sev_type[1]])->latest('id')->pluck('title', 'id')->toArray();
        $data['location']   = Location::select('id', 'name')->pluck('name', 'id')->toArray();
        return view('pages.blank', $data);
    }
    public function runMigrations()
    {
        Artisan::call('migrate:fresh --seed');

        Artisan::call('cache:clear');

        Artisan::call('route:clear');

        Artisan::call('config:clear');

        Artisan::call('view:clear');

        return response()->json([
            'status' => 'success',
            'message' => 'All commands executed successfully!',
            'migrate_output' => Artisan::output(),
            'cache_clear_output' => Artisan::output(),
            'route_clear_output' => Artisan::output(),
            'config_clear_output' => Artisan::output(),
            'view_clear_output' => Artisan::output(),
        ]);
    }
    public function passport_expiry()
    {
        $user_id = auth()->user()->id;
        $users = Application::with('client')->get();
        // dd($users);
        foreach ($users as $user) {
            if ($user->passport_expiry) {
                $passportExpiry = Carbon::parse($user->passport_expiry);
                $alertDate = $passportExpiry->subDays(7);
                if (Carbon::now()->greaterThanOrEqualTo($alertDate)) {

                    $alert = Alert::where('client_id', $user->client->id)->where('type', 'passport_expiry')->where('status','unseen')->where('deleted_at','n')->first();
                    if (empty($alert)) {
                        Alert::create([
                            'client_id' => $user->client->id,
                            'name' => $user->client->name,
                            'email' => 'shoaibasad45@gmail.com',
                            'email_forward' => 'n',
                            'type' => 'passport_expiry',
                            'user_id' => $user_id,
                            'title' => 'Passport Expiry Alert',
                            'url' => route('application.index'),
                            'body' => json_encode([
                                'Your passport will expire on ' . $passportExpiry->format('M d, Y') . '. Please renew it.'
                            ]),
                            'message' => 'Dear ' . $user->client->name . ', 
                                Your passport is due to expire on ' . $passportExpiry->format('M d, Y') . '. 
                                To avoid any inconvenience or travel restrictions, please ensure to renew your passport promptly. 
                                Visit the passport renewal office or consult with your travel administrator for further guidance.',
                            'status' => 'unseen',
                            'deleted_at' => 'n',
                        ]);
                    }
                }
            }
        }

        foreach ($users as $user) {
            if ($user->visa_expiry_date) {
                $visaExpiry = Carbon::parse($user->visa_expiry_date);
                $alertDate = $visaExpiry->subDays(7);
                if (Carbon::now()->greaterThanOrEqualTo($alertDate)) {
                    $alert = Alert::where('client_id', $user->client->id)->where('type', 'visa_expiry_date')->where('status','unseen')->where('deleted_at','n')->first();
                    if (empty($alert)) {
                        Alert::create([
                            'client_id' => $user->client->id,
                            'name' => $user->client->name,
                            'email' => 'shoaibasad45@gmail.com',
                            'email_forward' => 'n',
                            'type' => 'visa_expiry_date',
                            'user_id' => $user_id,
                            'title' => 'Visa Expiry Alert',
                            'url' => route('application.index'),
                            'body' => json_encode('Your Visa will expire on ' . $visaExpiry->format('M d, Y') . '. Please renew it.'),
                            'message' => 'Dear ' . $user->client->name . ', 
                                Your visa is set to expire on ' . $visaExpiry->format('M d, Y') . '. 
                                To ensure uninterrupted travel or stay, kindly proceed with the renewal process at your earliest convenience. 
                                If assistance is needed, please contact the relevant authority or immigration office.',
                            'status' => 'unseen',
                            'deleted_at' => 'n',
                        ]);
                    }
                }
            }
        }

        foreach ($users as $user) {
            if ($user->client && $user->client->dob) {
                $dob = Carbon::parse($user->client->dob);
                $currentYearDob = $dob->copy()->year(Carbon::now()->year);
                $alertDate = $currentYearDob->subDays(2);
                if (Carbon::now()->greaterThanOrEqualTo($alertDate)) {
                    $alert = Alert::where('client_id', $user->client->id)->where('type', 'date_of_birth')->where('status','unseen')->where('deleted_at','n')->first();
                    if (empty($alert)) {
                        Alert::create([
                            'client_id' => $user->client->id,
                            'name' => $user->client->name,
                            'email' => 'shoaibasad45@gmail.com',
                            'email_forward' => 'n',
                            'type' => 'date_of_birth',
                            'user_id' => $user_id,
                            'title' => 'Date of Birth Alert',
                            'url' => route('client.index'),
                            'body' => json_encode('Dear ' . $user->client->name . ', your date of birth is recorded as ' . $dob->format('M d, Y') . '. Please verify and update it if needed to avoid any discrepancies in your records.'),
                            'message' => 'Dear ' . $user->client->name . ', your date of birth is recorded as ' . $dob->format('M d, Y') . '. Please verify and update it if needed to avoid any discrepancies in your records.',
                            'status' => 'unseen',
                            'deleted_at' => 'n',
                        ]);
                    }
                }
            }
        }
    }
    public function fetchUnseenAlerts()
    {
        $user_id = auth()->user()->id;
        $alerts = Alert::where('user_id', $user_id)
            ->where('status', 'unseen')
            ->orderBy('created_at', 'desc')
            ->get();
        $alerts->each(function ($alert) {
            $alert->body = json_decode($alert->body);
        });

        return response()->json([
            'alerts' => $alerts,
            'count' => $alerts->count()
        ]);
    }
    public function updateStatus(Request $request)
    {
        $alert = Alert::find($request->alert_id);
        $alert->status = 'seen';
        $alert->save();

        return response()->json(['success' => true]);
    }
    public function alert_delete(Request $request)
    {
        $user_id = auth()->user()->id;
        $alerts = Alert::where('user_id', $user_id)
            ->where('status', 'unseen')
            ->orderBy('created_at', 'desc')
            ->get();
        $alert = Alert::find($request->alert_id);
        $alert->deleted_at='y';
        $alert->status = 'seen';
        $alert->save();
        return response()->json([
            'count' => $alerts->count(),
            'success' => true,
        ]);
    }
}
