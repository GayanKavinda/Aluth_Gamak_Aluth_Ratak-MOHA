@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>Edit User</b>
                        <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ url('users/' . $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" style="font-size: 14px;" id="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" readonly value="{{ $user->email }}" class="form-control" style="font-size: 14px;" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" style="font-size: 14px;" id="password">
                            @if ($passwordRequired)
                                <small class="text-muted">Leave blank to keep the existing password.</small>
                            @endif
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Add input fields for other attributes -->
                        <div class="mb-3">
                            <label for="position">Position</label>
                            <input type="text" name="position" value="{{ $user->position }}" class="form-control" style="font-size: 14px;" id="position">
                        </div>

                        <div class="mb-3">
                            <label for="workplace">Workplace</label>
                            <input type="text" name="workplace" value="{{ $user->workplace }}" class="form-control" style="font-size: 14px;" id="workplace">
                        </div>

                        <div class="mb-3">
                            <label for="district">District</label>
                            <input type="text" name="district" value="{{ $user->district }}" class="form-control" style="font-size: 14px;" id="district" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="telephone">Telephone</label>
                            <input type="text" name="telephone" value="{{ $user->telephone }}" class="form-control" style="font-size: 14px;" id="telephone">
                            @error('telephone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ga_email">GA Email</label>
                            <input type="email" name="ga_email" value="{{ $user->ga_email }}" class="form-control" style="font-size: 14px;" id="ga_email">
                            @error('ga_email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="date_of_appointment">Date of Appointment</label>
                            <input type="date" name="date_of_appointment" value="{{ $user->date_of_appointment }}" style="font-size: 14px;" class="form-control" id="date_of_appointment">
                        </div>

                        <div class="mb-3">
                            <label for="num_divisional_secretariats">Number of Divisional Secretariats</label>
                            <input type="number" name="num_divisional_secretariats" value="{{ $user->num_divisional_secretariats }}" class="form-control" style="font-size: 14px;" id="num_divisional_secretariats">
                        </div>

                        <div class="mb-3">
                            <label for="num_village_officer_domains">Number of Village Officer Domains</label>
                            <input type="number" name="num_village_officer_domains" value="{{ $user->num_village_officer_domains }}" class="form-control" style="font-size: 14px;" id="num_village_officer_domains">
                        </div>

                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" class="form-control" style="font-size: 14px;" multiple>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option 
                                        value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected':'' }}
                                    >
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                            @error('roles')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" style="font-size: 14px;">Update</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
