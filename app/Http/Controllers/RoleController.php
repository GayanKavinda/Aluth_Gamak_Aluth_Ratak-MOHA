<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    

    public function index()
    {
        $roles = Role::get();
        return view('roles-permission.role.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('roles-permission.role.create');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
                ]
            ]);

            Role::create([
                'name' => $request->name
            ]);

            // Log the activity
            activity()->log("Role {$request->name} created by " . Auth::user()->name);

            return redirect('roles')->with('status', 'Roles Created Successfully');
    }

    public function edit(Role $role)
    {

        return view('roles-permission.role.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $oldName = $role->getOriginal('name'); // Fetch the original name before updating

        $role->update([
            'name' => $request->name
        ]);

        // Log the activity with previous and new names
        activity()->log("Role {$oldName} updated to {$role->name} by " . Auth::user()->name);

        return redirect('roles')->with('status','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        // Log the activity
        activity()->log("Role {$role->name} deleted by " . Auth::user()->name);

        return redirect ('roles')->with('status','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $role->id)
        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();

        return view('roles-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions added to role');
    }
}
