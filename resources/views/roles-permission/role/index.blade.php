@extends('layouts.app')

@section('content')

<!-- <div class="container mt-3">
        <a href="{{'roles'}}" class="btn btn-primary mx-2">Roles</a>
        <a href="{{'permissions'}}" class="btn btn-info mx-2">Permissions</a>
        <a href="{{'users'}}" class="btn btn-success mx-2">Users</a>
        <a href="{{'index'}}" class="btn btn-danger mx-2">Index</a>
        <a href="{{'create'}}" class="btn btn-primary mx-2">Form</a>
</div> -->

<style>
    .card-header h4 {
        font-size: 18px; /* Adjust the font size as needed */
    }

    .btn {
        font-size: 14px; /* Adjust the font size of buttons */
    }

    table {
        font-size: 14px; /* Set the font size for table elements */
    }

    th, td {
        font-size: 14px; /* Ensure table headers and data have the same font size */
    }

    /* You can add more CSS rules to adjust font size for other elements */
</style>

<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
            <div class="card-header">
                <h4>Roles
                    @can('create role')
                    <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">
                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">add</span>
                        <span style="vertical-align: middle;">Add Roles</span>
                    </a>
                    @endcan
                </h4>
            </div>

                @can('view role')
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @can('update role')
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn" style="background-color: #633974; color: white;">
                                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">edit</span>
                                        <span style="vertical-align: middle;">Add / Edit Permission</span>
                                    </a>
                                    @endcan
                                    
                                    @can('edit role name')
                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn" style="background-color: #138D75; color: white;">
                                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">edit</span>
                                        <span style="vertical-align: middle;">Edit Role Name</span>
                                    </a>
                                    @endcan

                                    @can('delete role')
                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger mx-2" onclick="return confirm('Are you sure you want to delete this role?')">
                                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">delete</span>
                                        <span style="vertical-align: middle;">Delete</span>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endcan
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
