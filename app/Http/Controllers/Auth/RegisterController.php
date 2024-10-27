<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Include the Districts.php file at the top of your RegisterController
include_once app_path('Districts.php');

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show the registration form with districts dropdown
    public function showRegistrationForm()
    {
        // Call the getAllDistricts() function from Districts.php
        $districts = getAllDistricts();

        // Pass districts data to the registration view
        return view('auth.register', compact('districts'));
    }

    // Add this method to pass districts data to the registration view
    public function registerAllDistricts()
    {
        // Call the getAllDistricts() function from Districts.php
        $districts = getAllDistricts();

        // Pass districts data to the registration view
        return view('auth.register', compact('districts'));
    }


    // Validate registration data
    protected function validator(array $data)
    {
        return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'position' => ['required', 'string', 'max:255'],
        'workplace' => ['required', 'string', 'max:255'],
        'date_of_appointment' => ['required', 'date'],
        'district' => ['required', 'string'],
        'num_divisional_secretariats' => ['required', 'integer'],
        'num_village_officer_domains' => ['required', 'integer'],
        'telephone' => ['required', 'string', 'max:15'], // Add validation rule for telephone
        'ga_email' => ['required', 'string', 'email', 'max:255'], // Add validation rule for ga_email
        ]);
    }

    // Create a new user after validation
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'position' => $data['position'],
            'workplace' => $data['workplace'],
            'date_of_appointment' => $data['date_of_appointment'],
            'district' => $data['district'],
            'num_divisional_secretariats' => $data['num_divisional_secretariats'],
            'num_village_officer_domains' => $data['num_village_officer_domains'],
            'telephone' => $data['telephone'], // Include telephone field
            'ga_email' => $data['ga_email'], // Include ga_email field
        ]);
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    
}
