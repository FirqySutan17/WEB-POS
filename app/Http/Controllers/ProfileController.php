<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        return view('admin.profile.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        DB::beginTransaction();
        try {
            $file = $request->file('image');

            $update_data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ];

            if (!empty($file)) {
                $namefile = $file->getClientOriginalName();
                $file->move('file_upload', $namefile);
                $update_data['image'] = $namefile;
            }

            $update= DB::table('users')->where('id', $user->id)->update($update_data);
            Alert::success('Update User', 'Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }

        return redirect()->route('profile.edit');

    }
}
