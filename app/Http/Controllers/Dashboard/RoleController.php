<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolesRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller{

    public function index(){

        $roles = Role::get();
        return view('dashboard.roles.index', compact('roles'));

    }

    public function create(){
        return view('dashboard.roles.create');
    }

    public function store(RolesRequest $request){
        try {

            $role = $this->process(new Role, $request);
            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => __('admin/messages.success')]);
            else
                return redirect()->route('admin.roles.index')->with(['error' => __('admin/messages.error')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.roles.index')->with(['error' => __('admin/messages.error')]);
        }
    }

    public function edit($id){
        $role = Role::findOrFail($id);
        return view('dashboard.roles.edit',compact('role'));
    }

    public function update(RolesRequest $request, $id){
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role)
                return redirect()->route('admin.roles.index')->with(['success' => __('admin/messages.success')]);
            else
                return redirect()->route('admin.roles.index')->with(['error' => __('admin/messages.error')]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.roles.index')->with(['error' => __('admin/messages.error')]);
        }
    }

    public function destroy($role_id){
        try {
            $role = Role::find($role_id);

            if (!$role){
                return redirect()->route('admin.roles')->with(['error' => __('admin/messages.role not found')]);
            }

            $role->delete();

            return redirect()->route('admin.roles')->with(['success' => __('admin/messages.deleted successfully')]);

        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => __('admin/messages.error')]);
        }
    }


    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = json_encode($r->permissions);
        $role->save();
        return $role;
    }

}
