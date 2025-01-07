<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function add($id = null)
    {
        $data['client'] = $id ? Client::find($id) : new Client(); // Return a new Client instance if $id is null
        $data['role'] = auth()->user()->role;
        $data['staffs'] = User::where('role', 'Staff')->get();

        return view('pages.client.add', $data);
    }
    public function index()
    {
        $user = auth()->user();
        $data['user'] = $user;
        $data['clients'] = Client::all();
        return view('pages.client.listing', $data);
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $page_name = 'client';
        if (!view_permission($page_name)) {
            return redirect()->back();
        }
        $saved = Client::updateOrCreate(
            ['id' => $request->id ?? null],
            [
                'name'                 => $request->name,
                'sur_name'             => $request->sur_name,
                'email'                => $request->email,
                'contact_no'           => $request->contact_no,
                'refer_person'         => $request->refer_person,
                'dob'                  => $request->dob,
                'staff_id'             => $request->staff_id,
                'created_by'           => $user->id,
            ],
        );
        $message = "Client " . ($request->id ? "Updated" : "Created") . " Successfully";
        return redirect()->route('client.index')->with('message', $message);
    }
    public function client_detail_page($id)
    {
        $data['detail_page']=Client::find($id);
        return response()->json($data);
    }
    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->back()->with('message', 'Successfull Deleted');
    }
}
