@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

            <div class="card">
                <div class="card-header">
                    <h4>Role : {{ $role->name }}
                        <a href="{{ url('roles') }}" class="btn btn-danger float-end">
                            <span class="material-icons" style="vertical-align: middle; font-size: 16px;">arrow_back</span>
                            <span style="vertical-align: middle;">Back</span>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                        <div class="mb-3">
                    
                    @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                        <label for="">Permissions</label>

                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-2">
                                <label>
                                    <input 
                                        type="checkbox" 
                                        name="permission[]" 
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                        />
                                        {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <span class="material-icons" style="vertical-align: middle; font-size: 16px;">update</span>
                                <span style="vertical-align: middle;">Update Permissions</span>
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