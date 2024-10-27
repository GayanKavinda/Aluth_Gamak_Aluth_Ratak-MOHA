@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="custom-heading"> Create Roles
                        <a href=" {{ url('roles')}} " class="btn btn-danger float-end">
                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">arrow_back</span>
                        <span style="vertical-align: middle;">Back</span>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url ('roles')}}" method="POST">
                    @csrf

                        <div class="mb-3">
                        <label for="">Role Name</label>
                        <input type="text" name="name" class="form-control"> 
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="material-icons" style="vertical-align: middle; font-size: 16px;">save</span>
                                <span style="vertical-align: middle;">Save New Role</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>

    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    .custom-heading {
        font-family: "Roboto", sans-serif;
        font-weight: 400;
        font-style: normal;
        padding-top: 10px;
    }
</style>

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
