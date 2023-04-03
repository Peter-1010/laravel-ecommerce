<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller{

    public function editProfile(){

        $adminId  = auth('admin')->user()->id;
        $admin    = Admin::find($adminId);
        return view('dashboard.profile.edit', compact('admin'));

    }

    public function updateProfile(ProfileRequest $request){

        try {

            $adminId  = auth('admin')->user()->id;
            $admin    = Admin::find($adminId);

            if ($request->filled('password')){
                $request->merge(['password' => bcrypt($request->password)]);
            }

            unset($request['id'], $request['password_confirmation']);

            $admin->update($request->all());
            return redirect()->back()->with(['success' => __('admin/messages.success')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }

    }

}
