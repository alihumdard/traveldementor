<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $page_name = 'VFS';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $vfs = NULL;
        $message  = NULL;
        Session::forget('msg');

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
        $user = auth()->user();
        $page_name = 'countries';

        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $country = NULL;
        $message  = NULL;
        Session::forget('msg');

        if ($request->action == 'edit') {
            $country = Country::findOrFail($request->id)->toArray();
        } else if ($request->action == 'save') {
            $saved = Country::updateOrCreate(
                ['id' => $request->id ?? NULL],
                [
                    'name' => ucwords($request->name),
                    'status' => $this->status['Active'],
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
}
