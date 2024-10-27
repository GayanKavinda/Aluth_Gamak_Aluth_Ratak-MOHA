<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    

    public function index()
    {
        $permissions = Permission::get();
        return view('roles-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('roles-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
                ]
            ]);

            $permission = Permission::create([
                'name' => $request->name
            ]);

            // Log the activity
            activity()->log("Permission {$permission->name} created by " . Auth::user()->name);

            return redirect('permissions')->with('status', 'Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {

        return view('roles-permission.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $oldName = $permission->getOriginal('name'); // Fetch the original name before updating

        $permission->update([
            'name' => $request->name
        ]);

        // Log the activity with previous and new names
        activity()->log("Permission {$oldName} updated to {$permission->name} by " . Auth::user()->name);

        return redirect('permissions')->with('status','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();

        // Log the activity
        activity()->log("Permission {$permission->name} deleted by " . Auth::user()->name);

        return redirect ('permissions')->with('status','Permission Deleted Successfully');
    }
}
