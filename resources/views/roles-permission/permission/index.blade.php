@extends('layouts.app')

@section('content')

<style>
    .card-header h4 {
        font-size: 18px; /* Adjust the font size as needed */
    }

    .btn {
        font-size: 14px; /* Adjust the font size of buttons */
    }

    /* You can add more CSS rules to adjust font size for other elements */
</style>


<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Permissions
                        @can('create permission')
                        <a href="{{ url('permissions/create')}}" class="btn btn-primary float-end">Add Permissions</a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">
                    @can('view permission')
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr data-toggle="collapse" data-target="#row{{$permission->id}}" class="accordion-toggle">
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                                        @endcan

                                        @can('delete permission')
                                        <a href="{{ url('permissions/'.$permission->id.'/delete') }}" class="btn btn-danger btn-sm mx-2">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="hiddenRow">
                                        <div class="accordian-body collapse" id="row{{$permission->id}}">
                                            Details go here for permission {{$permission->id}}
                                        </div>
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
</div>
@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->