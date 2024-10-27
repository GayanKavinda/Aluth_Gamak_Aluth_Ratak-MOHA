@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Role
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">
                            <span class="material-icons" style="vertical-align: middle; font-size: 16px;">arrow_back</span>
                            <span style="vertical-align: middle;">Back</span>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/' . $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                        <div class="mb-3">
                            <label for="">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control"> 
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="material-icons" style="vertical-align: middle; font-size: 16px;">update</span>
                                <span style="vertical-align: middle;">Update Role Name</span>
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

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
