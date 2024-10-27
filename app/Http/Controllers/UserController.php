<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Activitylog\Models\Activity; // Add this
use Illuminate\Support\Facades\Auth; // Add this

// Include the Districts.php file at the top of your RegisterController
include_once app_path('Districts.php');

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('district', 'like', '%' . $search . '%')
                    ->orWhere('telephone', 'like', '%' . $search . '%')
                    ->orWhere('ga_email', 'like', '%' . $search . '%')
                    ->orWhere('position', 'like', '%' . $search . '%')
                    ->orWhere('workplace', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Paginate users with 10 users per page

        return view('roles-permission.user.index', [
            'users' => $users,
            'search' => $search, // Pass the search term to the view
        ]);
    }


    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $districts = getAllDistricts(); // Assuming you have a function to fetch districts
        return view('roles-permission.user.create', [
            'roles' => $roles,
            'districts' => $districts,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'position' => 'required|string|max:255',
            'workplace' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'date_of_appointment' => 'required|date',
            'num_divisional_secretariats' => 'required|integer',
            'num_village_officer_domains' => 'required|integer',
            'telephone' => 'required|string|max:15', // Add validation rule for telephone
            'ga_email' => 'required|string|email|max:255', // Add validation rule for ga_email
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'workplace' => $request->workplace,
            'district' => $request->district,
            'date_of_appointment' => $request->date_of_appointment,
            'num_divisional_secretariats' => $request->num_divisional_secretariats,
            'num_village_officer_domains' => $request->num_village_officer_domains,
            'telephone' => $request->telephone, // Include telephone field
            'ga_email' => $request->ga_email, // Include ga_email field
        ]);

        $user->syncRoles($request->roles);

        // Log the activity
        activity()->log("User {$user->name} created by " . Auth::user()->name);

        return redirect('/users')->with('status', 'User created successfully with roles');
    }   

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();

        // Determine if password is required based on nullable rule
        $passwordRequired = !is_null($user->password);

        return view('roles-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
            'passwordRequired' => $passwordRequired,
            'positions' => ['Position1', 'Position2', 'Position3'], // Example positions
            'workplaces' => ['Workplace1', 'Workplace2', 'Workplace3'], // Example workplaces
            'districts' => getAllDistricts(), // Assuming you have a function to fetch districts
            'telephone' => $user->telephone, // Pass the user's telephone attribute
            'ga_email' => $user->ga_email, // Pass the user's ga_email attribute
            'date_of_appointment' => $user->date_of_appointment, // Pass the user's date_of_appointment attribute
            'num_divisional_secretariats' => $user->num_divisional_secretariats, // Pass the user's num_divisional_secretariats attribute
            'num_village_officer_domains' => $user->num_village_officer_domains, // Pass the user's num_village_officer_domains attribute
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
            'telephone' => 'required|string|max:15', // Add validation rule for telephone
            'ga_email' => 'required|string|email|max:255', // Add validation rule for ga_email
        ]);

        // Get the original name before updating
        $oldName = $user->name;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'workplace' => $request->workplace,
            'district' => $request->district,
            'telephone' => $request->telephone, // Include telephone field
            'ga_email' => $request->ga_email, // Include ga_email field
            'date_of_appointment' => $request->date_of_appointment,
            'num_divisional_secretariats' => $request->num_divisional_secretariats,
            'num_village_officer_domains' => $request->num_village_officer_domains,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user data and roles
        $user->update($data);
        $user->syncRoles($request->roles);

        // Log the activity with previous and new names
        activity()->log("User '{$oldName}' updated to '{$user->name}' by " . Auth::user()->name);

        return redirect('/users')->with('status', 'User Updated successfully with roles');
    }  

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        // Log the activity
        activity()->log("User {$user->name} deleted by " . Auth::user()->name);

        return redirect()->route('users.index')->with('status', 'User Deleted Successfully');
    }
}
