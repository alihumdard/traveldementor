<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\ConnectionException;
use App\Models\User;
use App\Models\Currency;
use App\Models\Location;

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
                return view('pages.dashbords.super_admin', compact('user'));
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
            $data['staff'] = User::where(['role' => user_roles('2'), 'sadmin_id' => $user->id])->latest('id')->get()->toArray();
        }

        return view('pages.profile.staff', $data);
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
                ->where(['users.role' => user_roles('3'), 'users.sstaff_id' => $user->id])
                ->select('users.*', 'staff.name as staff_name', 'staff.user_pic as staff_pic', 'staff.email as staff_email')
                ->orderBy('users.id', 'desc')
                ->get()
                ->toArray();
            $staffs_list = User::where(['role' => user_roles('2'), 'sstaff_id' => $user->id])->orderBy('id', 'desc')->select('id', 'name')->get()->toArray();

            return view('pages.profile.users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3'), 'staffs_list' => $staffs_list]);
        } else {

            $users = User::where(['role' => user_roles('3'), 'staff_id' => $user->id])->orderBy('id', 'desc')->get()->toArray();
            return view('pages.profile.users', ['data' => $users, 'user' => $user, 'add_as_user' => user_roles('3')]);
        }
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
                    'sadmin_id' => $user->id,
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

    public function settings()
    {
        $user = auth()->user();
        $page_name = 'settings';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }

        $user = auth()->user();
        return view('pages.profile.settings', ['user' => $user]);
    }
}
