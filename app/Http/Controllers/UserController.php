<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:User Show', ['only' => 'index']);
        $this->middleware('permission:User Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:User Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:User Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = [];
        if ($request->get('keyword')) {
            $users = User::search($request->keyword)->orderBy('created_at', 'asc')->paginate(25);
        } else {
            $users = User::orderBy('created_at', 'asc')->paginate(25);
        }
        return view('admin.users.index', [
            'users' => $users,
        ]);

        // dd($);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::table('roles')
            ->orderBy('id', 'asc')
            ->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:30",
                "role" => "required",
                "office" => "required",
                "phone_number" => "required",
                "employee_id" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:6|confirmed",
            ],
            []
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $file = $request->file('image');
            $namefile = '';
            if (!empty($file)) {
                $namefile = $file->getClientOriginalName();
                $file->move('file_upload', $namefile);
            }
            $user = User::create([
                'employee_id' => $request->employee_id,
                'phone_number' => $request->phone_number,
                'office' => $request->office,
                'status' => ($request->status) ? '1' : '0',
                'name' => $request->name,
                'email' => $request->email,
                'image' => $namefile,
                'password' => Hash::make($request->password),
                'status' => ($request->status) ? '1' : '0',
            ]);
            $user->assignRole($request->role);
            Alert::toast('User Added', 'success');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }

        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "role" => "required",
            ],
            []
        );

        if ($validator->fails()) {
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
        
            $update_data = [
                'name' => $request->name,
                'email' => $request->email,
                'office' => $request->office,
                'status' => ($request->status) ? '1' : '0',
            ];

            $file = $request->file('image');
// dd($file);
            if (!empty($file)) {
                $namefile = $file->getClientOriginalName();
                $file->move('file_upload', $namefile);
                $update_data['image'] = $namefile;
            }

            $user->syncRoles($request->role);
            $update= DB::table('users')->where('id', $user->id)->update($update_data);
            
            Alert::toast('User Updated', 'success'); 
        } catch (\Throwable $th) {
            DB::rollBack();
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->removeRole($user->roles->first());
            $user->delete();
            Alert::toast('User Deleted', 'success');
        } catch (\Throwable $th) {
            DB::rollBack();
        } finally {
            DB::commit();
            return redirect()->route('users.index');
        }
    }
}
