@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><b style="font-size: 20px; color: #28EA15">Create User</b>
                        <a href=" {{ url('users')}} " class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url ('users')}}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" style="font-size: 14px;" id="name"> 
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" style="font-size: 14px;" id="email"> 
                        </div>
                    </div>

                    <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" style="font-size: 14px;" id="password"> 
                    </div>

                    <div class="col-md-4">
                        <label for="position">Position</label>
                        <input type="text" name="position" class="form-control" style="font-size: 14px;" id="position"> 
                    </div>

                    <div class="col-md-4">
                        <label for="workplace">Workplace</label>
                        <input type="text" name="workplace" class="form-control" style="font-size: 14px;" id="workplace"> 
                    </div>
                    </div>
            <hr>
                    <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="date_of_appointment">Date of Appointment</label>
                        <input type="date" name="date_of_appointment" class="form-control" style="font-size: 14px;" id="date_of_appointment"> 
                    </div>

                    <div class="col-md-3">
                        <label for="district">District</label>
                        <select name="district" class="form-control" style="font-size: 14px;" id="district">
                            <option value="" selected disabled>Select District</option>
                            @foreach ($districts as $district)
                            <option value="{{ $district }}">{{ $district }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="telephone">Telephone</label>
                        <input type="text" name="telephone" class="form-control" style="font-size: 14px;" id="telephone"> 
                    </div>
                    </div>
            <hr>
                    <div class="row mb-3">  
                    <div class="col-md-6">
                        <label for="ga_email">GA Email Address</label>
                        <input type="email" name="ga_email" class="form-control" style="font-size: 14px;" id="ga_email"> 
                    </div>
                    
                    <div class="col-md-3">
                        <label for="num_divisional_secretariats">Number of Divisional Secretariats</label>
                        <input type="number" name="num_divisional_secretariats" class="form-control" style="font-size: 14px;" id="num_divisional_secretariats"> 
                    </div>

                    <div class="col-md-3">
                        <label for="num_village_officer_domains">Number of Village Officer Domains</label>
                        <input type="number" name="num_village_officer_domains" class="form-control" style="font-size: 14px;" id="num_village_officer_domains"> 
                    </div>
                    </div>

                    <div class="mb-3">
                        <label for="roles">Roles</label>
                        <select name="roles[]" class="form-control" style="font-size: 14px;" multiple>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" style="font-size: 14px;">Create New User</button>
                    </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->