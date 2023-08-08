<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([

            'password' => Hash::make($request->get('password'))
        ]);
        Alert::success('Change Password', 'Password Changed');
        // dd($request->all());
        return redirect()->back();
    }
}
