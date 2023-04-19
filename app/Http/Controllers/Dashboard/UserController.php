<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller{

    public function index(){

        $users = Admin::latest()->where('id', '<>', auth()->id())->get();
        return view('dashboard.users.index', compact('users'));

    }

    public function create(){

        $roles = Role::get();
        return view('dashboard.users.create', compact('roles'));

    }

    public function store(AdminRequest $request){
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        if ($user->save())
            return redirect()->route('admin.users.index')->with(['success' => __('admin/messages.success')]);
        else
            return redirect()->route('admin.users.index')->with(['error' => __('admin/messages.error')]);

    }

    public function destroy($user_id){
        try {
            $user = Admin::find($user_id);

            if (!$user){
                return redirect()->route('admin.user')->with(['error' => __('admin/messages.user not found')]);
            }

            $user->delete();

            return redirect()->route('admin.user')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }

}
